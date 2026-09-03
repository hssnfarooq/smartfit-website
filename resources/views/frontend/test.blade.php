<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    {!! SEO::generate() !!}
    @include('frontend.inc.meta')
    <link rel="stylesheet" type="text/css" href="/assets/css/checkout.css">
</head>
<body>

  
  <livewire:payment-page>

  @include('frontend.inc.js')
  </body>
</html>