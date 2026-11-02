<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Import;
use App\Support\SupplierCatalogueCleaner;
use Illuminate\Http\Request;

use Lunar\FieldTypes\Text;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Lunar\Models\Brand;
use Lunar\Models\Product;
use Lunar\Models\ProductVariant;
use phpseclib3\Net\SFTP;
use RuntimeException;

ini_set('max_execution_time', 3000);

class ProductController extends Controller
{
    private $json_header, $sftp, $proizvod_folder, $naljepnica_folder;

    private $cijena_kemija_arr = [
        'BUDGET' => 22.50,
        'BUDGET WHOLESALE' => 22.50,
        'House Brand' => 22.50,

        'MID RANGE 2' => 27.50,
        'MID RANGE 3' => 27.50,
        'MID RANGE PREMIUM' => 27.50,

        'PREMIUM' => 32.50,

        'P' => 32.50,
        'M' => 27.50,
        'B' => 22.50,
    ];

    public function __construct(private SupplierCatalogueCleaner $supplierCatalogueCleaner)
    {
    }

    public function index(Request $request){
      return Product::paginate();
    }

    public function show(Product $product){
        return $product;
    }


    //za dohvačanje slika
    private function sftpConnect(){

        $this->sftp = new SFTP(env('SFTP_HOST'), 2222);
        if (!$this->sftp->login(env('SFTP_USERNAME'), env('SFTP_PASSWORD')))
            throw new \Exception('Login failed');

    }

    private function checkPic($proizvod, $naljepnica){       

        $this->proizvod_folder = env('PROIZVOD_FOLDER');
        $this->naljepnica_folder = env('NALJEPNICA_FOLDER');

        //proizvod - /Images/TyrePatterns
        if($this->sftp->file_exists($this->proizvod_folder.$proizvod) && $this->sftp->is_dir($this->proizvod_folder)){ 

                $slika = $this->proizvod_folder.$proizvod;

                //da li postoji i dole
                if(!Storage::disk('public')->exists($slika)){

                    Storage::disk('public')->put($slika, $this->sftp->get($slika));

                }else{

                    //ako postoji, onda provjera jel noviji gornji file, ako nije onda ne treba niš
                    if(Storage::disk('public')->lastModified($slika) < $this->sftp->filemtime($slika)){
                        Storage::disk('public')->put($slika, $this->sftp->get($slika));
                    }

                }
    
        }
            
        //naljepnica - /Images/TyreLabels-EU2020-740
        if($this->sftp->file_exists($this->naljepnica_folder.$naljepnica) && $this->sftp->is_dir($this->naljepnica_folder)){

            $slika = $this->naljepnica_folder.$naljepnica;
            //da li postoji i dole
            if(!Storage::disk('public')->exists($slika)){

                Storage::disk('public')->put($slika, $this->sftp->get($slika));

            }else{

                //ako postoji, onda provjera jel noviji gornji file, ako nije onda ne treba niš
                if(Storage::disk('public')->lastModified($slika) < $this->sftp->filemtime($slika)){
                    Storage::disk('public')->put($slika, $this->sftp->get($slika));
                }

            }
  
        }

    }

    public function importCSV(): string
    {
        
        $import = Import::where('gotov', 1)->whereDate('created_at', date('Y-m-d'))->first();
        if(!$import){
            $importFile = base_path('import/'.env('IMPORT_PARTNER').'/'.env('IMPORT_FILE'));

            if (! is_readable($importFile)) {
                throw new RuntimeException('Supplier import file is not readable.');
            }

            if (env('IMPORT_PARTNER') === 'stapletons') {
                $this->sftpConnect();
            }

            if ($this->supplierCatalogueCleaner->clear() >= 0) {
                return $this->startImport($importFile);

            }else 
                return 'Delete ERROR';

        }else{
            return 'Imported '.$import->title;
        }
            
    }
    
    private function startImport(string $importFile): string
    {
        $import = Import::create([
            'title' => date("d-m-Y H:i:s"),
        ]);
        /*
        MOŽDA SE BUDE UPLOADAO JEDNOG DANA
        $request->validate([
            'import_csv' => 'required|mimes:csv',
        ]);
        //read csv file and skip data
        $file = $request->file('import_csv');
        $handle = fopen($file->path(), 'r');
*/
        $handle = fopen($importFile, 'r');
        //echo 'import/'.env('IMPORT_PARTNER').'/'.env('IMPORT_FILE').'<br>';

        if ($handle === false) {
            throw new RuntimeException('Supplier import file could not be opened.');
        }

        $i = 0;
        while (($data = fgetcsv($handle)) !== false) {
            $i++;
            $this->spremiProizvod($data, $i);
        }

        fclose($handle);

        $import->gotov = true;
        $import->end_time =  date("d-m-Y H:i:s"); 
        $import->title .=  ' - '.date("d-m-Y H:i:s");

        $import->save();

        return 'Products imported: '.$import->title;
    }

    private function spremiProizvod($data, $red){

        //provjera jel to prvi red di su imena kolona
        if($red == 1){
            $this->json_header = Arr::map($data, function (string $value) {
                $tmp = strtolower(str_replace(" ", "_", $value));
                $tmp = strtolower(str_replace(".", "", $tmp));
                $tmp = strtolower(str_replace("/", "_", $tmp));
                $tmp = strtolower(str_replace("&", "and", $tmp));
                return strtolower($tmp);
            });
        }else{
            
            $json_body = Arr::mapWithKeys($data, function (string $value, int $key) {
                return [$this->json_header[$key] => $value];
            });

          
            //brand
            $brand = Brand::firstOrCreate([
                'name' =>  $data[env('IMPORT_PARTNER') === 'stapletons' ? 1 : 19],//19 je edentyres // 1 je stapletons
            ]);

            $product = Product::updateOrCreate([
                'product_type_id' => 1,//hardkodano gume
                'status' => 'published',
                'brand_id' => $brand->id,
                't_import_json' => json_encode($json_body),
                'csv_import' => 1,
                'attribute_data' => [
                   // 'iiiii' => new Text($red),
                    'name' => new Text($data[env('IMPORT_PARTNER') === 'stapletons' ? 2 : 3]),
                    'description' => new Text(''),
                ],
            ]);
        
            $jedini = ProductVariant::create([
                'sku' => $data[0],
                'product_id' => $product->id,
                'tax_class_id' => 1,//hardkodano
                'csv_import' => 1,
                'shippable' => 0,
                /*'length_value' => 17,
                'length_unit' => 'in',
                'height_value' => 66,
                'height_unit' => 'mm',
                'width_value' => 175,
                'width_unit' => 'mm',*/
            ]);

            $tmp_cijena = $data[env('IMPORT_PARTNER') === 'stapletons' ? 14 : 5];
             //////////////////
            //KEMIJA ZA CIJENE -> Marža + fake pdv -> pdv 25% je privremeno na ruku dok se ne prebace na PDV (tad treba maknut)
            $marza = 0;
            $fake_pdv = 20;            
            if(isset($this->cijena_kemija_arr[$data[env('IMPORT_PARTNER') === 'stapletons' ? 18 : 20]]))
                $marza = $this->cijena_kemija_arr[$data[env('IMPORT_PARTNER') === 'stapletons' ? 18 : 20]];         
            else 
                $tmp_cijena = 0;//jer ako nema oznaku za maržu stavljamo 0 za svaki slučaj  
            $tmp_cijena += $marza;
            $tmp_cijena += ($fake_pdv/100) * $tmp_cijena;
            /////
    
            $jedini->prices()->create([
                'price' => ($tmp_cijena*100),//Price 13	Retail 14
                'currency_id' => 1,//funte u bazi
                'csv_import' => 1,
            ]);


            if(env('IMPORT_PARTNER') === 'stapletons'){
                $tmp_slika = strtoupper(str_replace(" ", "_", $data[25]));
                $tmp_naljepnica = strtoupper(str_replace(" ", "_", $data[26]));
                $this->checkPic($tmp_slika.'.png', $tmp_naljepnica);//proizvod, naljepnica
            }            
                
        }

    }

}
