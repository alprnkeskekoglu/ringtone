<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

    <title>Dawnstar</title>

    <meta name="description" content="Dashmix - Bootstrap 4 Admin Template &amp; UI Framework created by pixelcave and published on Themeforest">
    <meta name="author" content="pixelcave">
    <meta name="robots" content="noindex, nofollow">

    <!-- Open Graph Meta -->
    <meta property="og:title" content="Dashmix - Bootstrap 4 Admin Template &amp; UI Framework">
    <meta property="og:site_name" content="Dashmix">
    <meta property="og:description" content="Dashmix - Bootstrap 4 Admin Template &amp; UI Framework created by pixelcave and published on Themeforest">
    <meta property="og:type" content="website">
    <meta property="og:url" content="">
    <meta property="og:image" content="">
    <link rel="shortcut icon" href="{!! asset("vendor/dawnstar/media/favicons/favicon.png") !!}">
    <link rel="icon" type="image/png" sizes="192x192" href="{!! asset("vendor/dawnstar/media/favicons/favicon-192x192.png") !!}">
    <link rel="apple-touch-icon" sizes="180x180" href="{!! asset("vendor/dawnstar/media/favicons/apple-touch-icon-180x180.png") !!}">
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Nunito+Sans:300,400,400i,600,700">
    <link rel="stylesheet" id="css-main" href="{!! asset("vendor/dawnstar/css/dashmix.min.css") !!}">
</head>
<body>

<div id="page-container" class="sidebar-o sidebar-dark enable-page-overlay side-scroll page-header-fixed main-content-narrow">

    @include('Dawnstar::layouts.header')

    @yield('content')

    @include('Dawnstar::layouts.footer')
</div>

<script src="{!! asset("vendor/dawnstar/js/dashmix.core.min.js") !!}"></script>
<script src="{!! asset("vendor/dawnstar/js/dashmix.app.min.js") !!}"></script>
<script src="{!! asset("vendor/dawnstar/js/plugins/jquery-sparkline/jquery.sparkline.min.js") !!}"></script>
<script>jQuery(function(){ Dashmix.helpers('sparkline'); });</script>
@stack('scripts')
</body>
</html>
