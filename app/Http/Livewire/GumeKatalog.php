<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Lunar\Models\Product;

class GumeKatalog extends Component
{

    /*
    {"stock_code":"1257017MSCONTACT","manufacturer":"CONTINENTAL","make_and_pattern":"CONTINENTAL SCONTACT","type":"C","size":"125\/70-17","width":"125","ratio":"70","dia":"17","speed":"M","load_spd":"98M","runflat":"","xl":"","winter":"","price":"47.30","retail":"47.30","stock":"3","ipc_code":"03113660000","stock_description":"125\/70R17 CI SCONTACT 98M","make_type":"P","season":"SUMMER","veh_class":"","rolling_res":"","wet_grip":"","noise_class_type":"","noise_performance":"","tyre_image_name":"CONTINENTAL_SCONTACT","label_image_name":"1257017MSCONTACT.png","ean":"4019238038651","weight":"4.63","oe_sidewall":"","oe_fitment":"","remarks":"","status":"","3peak":"","ice":"","eprel":"0","label_exempt":"Y","fleet":"56.76","online":"999.99"}

    {"product_stock_number":"1756514HZE03.005.01","product_ean":"6921109014221","product_manufacturer_code":"03.005.01","product_title":"175\/65R14 ZETA ZTR50 82H (CAR SUMMER)","product_group":"TYRES","product_best_match_image_url":"https:\/\/dcjqgkl774ppl.cloudfront.net\/70\/images\/ze-ztr50.jpg","price":"23.97","width":"175","aspect_ratio":"65","rim":"14","speed_rating":"H","load_index":"82","reinforced":"","vehicle_type":"CAR","product_type":"SUMMER","runflat":"false","rolling_resistance":"D","wet_grip":"D","noise_performance":"71","noise_class_type":"2","ec_vehicle_class":"C1","product_available":"30.0","brand_name":"ZETA","brand_group":"House Brand","model_name":"ZTR50"}
    */

    //protected $polja = ['season', 'width', 'ratio', 'dia', 'manufacturer', 'rolling_res', 'wet_grip', 'noise_performance', 'load_spd']; //stapletons
    protected $polja = ['product_type', 'width', 'aspect_ratio', 'rim', 'brand_name', 'rolling_resistance', 'wet_grip', 'noise_performance', 'load_index']; //edentyres

    private function checkQueryString(){
        $qs = request()->all();
        $return = array();
        foreach($qs as $key => $val){
            if(in_array($key, $this->polja) && !empty($val))
                $return['t_import_json->'.$key] = $val;
        }

        return $return;
    }

    private function tyreProductQuery()
    {
        return Product::query()
            ->where('product_type_id', 1)
            ->where('status', 'published')
            ->whereNotNull('t_import_json')
            ->whereHas('defaultUrl')
            ->whereHas('brand')
            ->whereHas('variants')
            ->with(['defaultUrl', 'brand', 'variants.prices']);
    }

   // select * from `lunar_products` where (json_unquote(json_extract(`t_import_json`, '$."product_type"')) = 'SUMMER') and `lunar_products`.`deleted_at` is null
  //  select * from `lunar_products` where (json_unquote(json_extract(`t_import_json`, '$."product_type"')) = 'SUMMER') and `lunar_products`.`deleted_at` is null

    public function getProizvodiProperty()
    {
        $data = $this->checkQueryString();

    
        /*var_dump($data);
        echo('-----------');
        var_dump(request()->all());
        echo(Product::where([['t_import_json->product_type', 'SUMMER']])->toRawSql());
        echo('<br>-----------<br>');
        die(Product::where($data)->toRawSql());*/
        $query = $this->tyreProductQuery();

        if (count($data) > 0) {
            $query->where($data);
        } else {
            $query->inRandomOrder()->limit(20);
        }

        $proizvodi = $query->get();
        
        return $proizvodi;
    }

    public function getRandomProizvodiProperty()
    {
        return $this->tyreProductQuery()->inRandomOrder()->limit(20)->get();
    }

    public function render()
    {
        return view('livewire.gume-katalog');
    }
}
