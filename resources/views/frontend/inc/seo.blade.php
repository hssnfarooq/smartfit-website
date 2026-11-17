@php
    $siteSeo = \App\Support\SiteSeo::resolve(
        $item ?? null,
        $lw ?? null,
        $slug ?? null,
    );
@endphp

<title>{{ $siteSeo['title'] }}</title>
<meta name="description" content="{{ $siteSeo['description'] }}">
<link rel="canonical" href="{{ $siteSeo['canonical'] }}">

<meta property="og:locale" content="{{ $siteSeo['locale'] }}">
<meta property="og:type" content="website">
<meta property="og:site_name" content="Smartfit Autos">
<meta property="og:title" content="{{ $siteSeo['title'] }}">
<meta property="og:description" content="{{ $siteSeo['description'] }}">
<meta property="og:url" content="{{ $siteSeo['canonical'] }}">

<meta name="twitter:card" content="summary">
<meta name="twitter:title" content="{{ $siteSeo['title'] }}">
<meta name="twitter:description" content="{{ $siteSeo['description'] }}">
