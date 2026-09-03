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
@endphp
<section class="page_banner" style="background-image: url('{{$slika}}');{{$stil}}">
    <div class="container">
    <ul class="breadcrumb_nav unordered_list">
        <li><a href="/">Home</a></li>
        <li>{!!html_entity_decode($block->input('title'))!!}</li>
    </ul>
    <h1 class="page_title wow{{$font}}" data-splitting>{!!html_entity_decode($block->input('title'))!!}</h1>
    </div>
</section>