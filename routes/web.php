<?php

use App\Http\Controllers\PageDisplayController;
use App\Http\Livewire\ProizvodOpsirno;
use App\Repositories\PageRepository;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/ocisti-cache', function() {
    Artisan::call('optimize:clear');
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    try {
        Artisan::call('storage:link');
    } catch (\Throwable $e) {}
    try {
        Artisan::call('vendor:publish', ['--tag' => 'laravel-cookie-consent', '--force' => true]);
    } catch (\Throwable $e) {}
    return 'Laravel cache je uspješno očišćen!';
});
Route::get('/napravi-link', function() {
    Artisan::call('storage:link');
    try {
        Artisan::call('vendor:publish', ['--tag' => 'laravel-cookie-consent', '--force' => true]);
    } catch (\Throwable $e) {}
    return 'Simbolička veza je uspješno kreirana!';
});

// Fallback image serving for shared hosting (when symlink is missing)
Route::get('/storage/{folder}/{filename}', function ($folder, $filename) {
    $path = storage_path('app/public/' . $folder . '/' . $filename);
    if (file_exists($path)) {
        return response()->file($path);
    }
    $decodedPath = storage_path('app/public/' . $folder . '/' . urldecode($filename));
    if (file_exists($decodedPath)) {
        return response()->file($decodedPath);
    }
    abort(404);
})->where('filename', '.*');

// Fallback cookie consent asset serving
Route::get('/vendor/devrabiul/laravel-cookie-consent/{type}/{filename}', function ($type, $filename) {
    $publicPath = public_path('vendor/devrabiul/laravel-cookie-consent/' . $type . '/' . $filename);
    if (file_exists($publicPath)) {
        return response()->file($publicPath, [
            'Content-Type' => ($type === 'css' ? 'text/css' : 'application/javascript')
        ]);
    }
    $vendorPath = base_path('vendor/devrabiul/laravel-cookie-consent/assets/' . $type . '/' . $filename);
    if (file_exists($vendorPath)) {
        return response()->file($vendorPath, [
            'Content-Type' => ($type === 'css' ? 'text/css' : 'application/javascript')
        ]);
    }
    abort(404);
});

// Fallback asset serving for assets/ directory
Route::get('/assets/{path}', function ($path) {
    $publicPath = public_path('assets/' . $path);
    if (file_exists($publicPath)) {
        $ext = pathinfo($publicPath, PATHINFO_EXTENSION);
        $mime = ($ext === 'svg') ? 'image/svg+xml' : (($ext === 'css') ? 'text/css' : (($ext === 'js') ? 'application/javascript' : null));
        return $mime ? response()->file($publicPath, ['Content-Type' => $mime]) : response()->file($publicPath);
    }
    abort(404);
})->where('path', '.*');

Route::post('{slug}', [\App\Http\Controllers\PageDisplayController::class, 'kontaktForma']);

Route::get('/test', function(PageRepository $pageRepository){
    $page = $pageRepository->forSlug('home-page');
    return view('frontend.test', ['item' => $page, 'header' => 'header', 'chunker' => App\Http\Controllers\PageDisplayController::dajChunker()]);
});
/*
Route::get('/stripe/create', function(){
    return view('frontend..stripe.create');
});
*/
Route::get('/', [PageDisplayController::class, 'index']);

Route::get('/tyres/{slug}', [PageDisplayController::class, 'gumaOpsirno']);
//Route::get('/products/tyres/{slug}', ProizvodOpsirno::class);


Route::get(env('STRIPE_PAYMENT_PAGE'), [PageDisplayController::class, 'paymentStranica']);

Route::get(env('STRIPE_PAYMENT_RESPONSE'), [PageDisplayController::class, 'paymentResponse']);

Route::get('/booking/order', [PageDisplayController::class, 'bookingStranica'])->name('booking');


Route::get('{slug}', [PageDisplayController::class, 'page'])->name('frontend.index');