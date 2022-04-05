<!DOCTYPE html>

<html lang="en" class="light">
    <!-- BEGIN: Head -->
    <head>
        <meta charset="utf-8">
        <link href="assets/images/logo.svg" rel="shortcut icon">

        <title>@yield('title')</title>
        <link rel="stylesheet" href="{{asset('assets/css/app.css')}}" />
    </head>
    <!-- END: Head -->
    <body class="app">
        <!-- BEGIN: Mobile Menu -->
        @include('layouts.partials.mobile-nav')
        <div class="flex">
           @include('layouts.partials.side-nav')
            <div class="content">
                @include('layouts.partials.top-bar')
                @yield('content')
            </div>
        </div>

        <script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=["your-google-map-api"]&libraries=places"></script>
        <script src="{{asset('assets/js/app.js')}}"></script>
    </body>
</html>