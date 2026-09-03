<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    {!! SEO::generate() !!}
    @include('frontend.inc.meta')
</head>

<body>

    <div class="page_wrapper">

        @include('frontend.inc.backtotop')

        @include('frontend.inc.header')

      <!-- Main Body - Start
      ================================================== -->
      <main class="page_content">

        {!! $item->renderNamedBlocks('default') !!}

      </main>

      <x-footer/>

    </div>
    <!-- Body Wrap - End -->

    @include('frontend.inc.js')

  </body>
</html>