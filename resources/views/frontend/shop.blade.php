<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    {!! SEO::generate() !!}
    @include('frontend.inc.meta')
</head>
@php
    $db_baza = 'innovationtest2_db';
    $db_user = 'innovationtest2_mysql_user';
    $db_password = 'B~{PcP~@l3@)';

    $db_error = 'Connection error.';
    $db_host = 'test2.idea-innovations.co.uk';    

    $mysqli = mysqli_connect($db_host, $db_user, $db_password, $db_baza);
    if (!$mysqli) {
        die( "Failed to connect to MySQL" );
    }
    mysqli_set_charset($mysqli, 'utf8');

    
    if(isset($_GET['pid']) && is_numeric($_GET['pid']))
        $proizvod_id = $_GET['pid'];
   
@endphp
<body>
    
    @include('frontend.inc.odrzavanje')

    <div class="page_wrapper">

        @include('frontend.inc.backtotop')

        @include('frontend.inc.header')

      <!-- Main Body - Start
      ================================================== -->
      <main class="page_content">

            @if (isset($proizvod_id))
                @include('frontend.fake-shop.opsirno')
            @else
                @include('frontend.fake-shop.ispis')
            @endif

      </main>

      <x-footer/>

    </div>
    @include('frontend.inc.js')

  </body>
</html>