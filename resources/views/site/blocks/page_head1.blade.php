@php
if($block->hasImage('slika', 'flexible')){
    $slika  =  $block->image('slika', 'flexible');
    $stil = 'background-position: center; background-color: unset; background-size:cover;';
    $font = ' bijeli';
}else{
    $slika  =  asset('assets/images/shapes/tyre_print_3.svg');
    $stil = '';
    $font = '';
}
$pageTitle = request()->is('contacts-kennings-auto-centre')
    ? 'CONTACT US'
    : html_entity_decode($block->input('title'));
$isAboutPage = request()->is('about-us');
if ($isAboutPage) {
    $slika = asset('assets/images/about/about-us-banner.webp');
    $stil = 'background-position: center; background-color: #f4f4f4; background-size: cover;';
    $font = '';
}
@endphp
<section class="page_banner{{ $isAboutPage ? ' page_banner--about' : '' }}" style="background-image: url('{{$slika}}');{{$stil}}">
    <div class="container">
    <ul class="breadcrumb_nav unordered_list">
        <li><a href="/">Home</a></li>
        <li>{{ $pageTitle }}</li>
    </ul>
    <h1 class="page_title wow{{$font}}" data-splitting>{{ $pageTitle }}</h1>
    </div>
</section>
