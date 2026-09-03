<?php

namespace App\Http\Controllers;

use App\Mail\FinishedMail;
use App\Mail\KontaktForma;
use App\Repositories\PageRepository;
use CwsDigital\TwillMetadata\Traits\SetsMetadata;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use App\Models\Chunker;
use App\Models\ContactForm;
use App\Models\Import;
use App\Models\Location;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Lunar\Models\Order;

class PageDisplayController extends Controller
{
    use SetsMetadata;

    public function index(PageRepository $pageRepository)
    {

        //Mail::to('igpetrovic@gmail.com')->send(new FinishedMail(null, 15));

        //new FinishedMail(null, 18);
        /*$order = Order::findOrfail(18);
        $chunker = $this->dajChunker();
        return view('mail.finished-mail', ['tekst' => $chunker['order_mail_text'], 'order' => $order]);
        die('---------');*/

        //if(request()->input('lok') != null)
        //    if($this->dolazakHandle(request()->input('lok'))) return redirect()->to('/booking/order');

        if (!request()->session()->exists(env('LOKACIJA_KUKI'))) {
            $lokacija_data = Location::findOrFail(2);
            request()->session()->put(env('LOKACIJA_KUKI'), $lokacija_data);
        }
        
        $page = $pageRepository->forSlug('home-page');

        return view('frontend.index', ['item' => $page, 'header' => 'bijelo', 'chunker' => $this->dajChunker()]);

    }

    public function page(string $slug, PageRepository $pageRepository): View
    {
        $page = $pageRepository->forSlug($slug);
        
        if (!$page) {
            abort(404);
        }
        
        $this->setMetadata($page);

        if (!request()->session()->exists(env('LOKACIJA_KUKI'))) {
            $lokacija_data = Location::findOrFail(2);
            request()->session()->put(env('LOKACIJA_KUKI'), $lokacija_data);
        }
        
        return view('frontend.index', ['item' => $page, 'header' => 'crno', 'chunker' => $this->dajChunker()]);
    }

    public function shop(PageRepository $pageRepository): View
    {
        $page = $pageRepository->forSlug('our-shop');

        if (!request()->session()->exists(env('LOKACIJA_KUKI'))) {
            $lokacija_data = Location::findOrFail(2);
            request()->session()->put(env('LOKACIJA_KUKI'), $lokacija_data);
        }

        return view('frontend.shop', ['item' => $page, 'header' => 'crno', 'chunker' => $this->dajChunker()]);
    }


    public function gumaOpsirno(string $slug)
    {
        return view('frontend.index', ['slug' => $slug, 'header' => 'crno', 'chunker' => $this->dajChunker(), 'lw' => 'proizvod-opsirno']);
    }

    public function bookingStranica()
    {
        $slug = '';
        return view('frontend.index', ['slug' => $slug, 'header' => 'crno', 'chunker' => $this->dajChunker(), 'lw' => 'booking-stranica']);
    }

    public function paymentStranica()
    {
        $slug = '';
        return view('frontend.index', ['slug' => $slug, 'header' => 'crno', 'chunker' => $this->dajChunker(), 'lw' => 'payment-page', 'chekout' => 'DA']);
    }
    public function paymentResponse()
    {
        $slug = '';
        return view('frontend.index', ['slug' => $slug, 'header' => 'crno', 'chunker' => $this->dajChunker(), 'lw' => 'payment-finish', 'chekout' => 'DA']);
    }

    //ovo je bilo za slučaj 281 univerzalnog weba...
    /*
    private function dolazakHandle($json){
        $json = json_decode($json);

        if(isset($json->lid) && is_numeric($json->lid)){
            $lokacija_data = $json->lid > 0 ? Location::findOrFail($json->lid) : [];
            request()->session()->put(env('LOKACIJA_KUKI'), $lokacija_data);

            //auto
            if(isset($json->auto)){
                $dvsa = new Dvsa();
                $auto_json = json_decode($dvsa->dohvatiAutoPodatke($json->auto));
                request()->session()->put(env('AUTO_KUKI'),  $auto_json);
            }

            return true;
        }
        
        return false;
    }
    */

    public function kontaktForma(Request $request)
    {


        $this->validate($request, [
            'title' => 'required',
            'email' => 'required|email',
            'captcha' => 'required|captcha'
            //'description' => 'required',
            //'telefon' => 'required',
            //'subject' => 'required',
        ],
        [
            'captcha.required' => env('CAPTCHA_REQUIRED_TEXT'),
            'captcha.captcha' => env('CAPTCHA_ERROR_TEXT')
        ]);
        
        ContactForm::create($request->all());
        //ne radi s anchorom pa ne vrača na naslovnici na kontakt formu
        //return back()->with('success', 'Thanks for contacting us!');
        //return redirect()->to(URL::previous() . "#contact-form")->with('success', 'Thanks for contacting us!');

        Mail::to(env('MAIL_TO_DEFAULT'))->send(new KontaktForma($request['title'], $request['email'], $request['phone'], $request['subject'], $request['question']));

        $chunker = $this->dajChunker();
        return redirect()->to(URL::previous() . "#cf")->with('ok', $chunker['contact_form_success']);
    }

    public static function odrzavanjeCheck(){
        //Role::all()->map();
        $import = Import::whereDate('created_at', date('Y-m-d'))->latest()->first();
       // echo 'ID: '.$import->id.' // Gotov: '.$import->gotov;
        return  $import ? !$import->gotov : false;
    }

    public static function dajChunker(){
        //Role::all()->map();
        $arr = array();
        Chunker::all()->map(function($item) use(&$arr) {
            $arr[$item->title] = $item->description;
        });
        return $arr;
    }
}
