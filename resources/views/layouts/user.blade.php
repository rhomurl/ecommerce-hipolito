<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="pragma" content="no-cache" />
        <meta http-equiv="cache-control" content="max-age=604800" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        @hasSection('title')

            <title>@yield('title') - {{ config('app.name') }}</title>
        @else
            <title>{{ config('app.name') }}</title>
        @endif

        <!-- Favicon -->
		<link href="{{ url(asset('favicon.ico')) }}" rel="shortcut icon" type="image/x-icon">

        <!-- jQuery -->
        <script src="{{ asset('js/jquery-2.0.0.min.js') }}" type="text/javascript"></script>

        <!-- Bootstrap4 files-->
        <script src="{{ asset('js/bootstrap.bundle.min.js') }}" type="text/javascript"></script>
        <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet" type="text/css"/>

        <!-- Font awesome 5 -->
        <link href="{{ asset('fonts/fontawesome/css/all.min.css') }}" type="text/css" rel="stylesheet">

        <!-- custom style -->
        <link href="{{ asset('css/ui.css') }}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('css/responsive.css') }}" rel="stylesheet" type="text/css" />

        <!-- custom javascript -->
        <script src="{{ asset('js/script.js') }}" type="text/javascript"></script>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css">

        <!-- Styles -->
        {{-- Tailwind CSS 
        <link rel="stylesheet" href="{{ url(mix('css/app.css')) }}">
        @livewireStyles--}}

        <!-- Scripts -->
        <script src="{{ url(mix('js/app.js')) }}" defer></script>

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
    </head>

    <body>
        
        <!-- ========================= FOOTER ========================= -->
        @include('components.user-header')
        <!-- ========================= FOOTER END // ========================= -->
            

        <!-- ========================= SECTION MAIN  ========================= -->
        @yield('body')
        <!-- ========================= SECTION END // ========================= -->
    
        <!-- ========================= FOOTER ========================= -->
        @include('components.user-footer')
        <!-- ========================= FOOTER END // ========================= -->
            

        @livewireScripts
    </body>
</html>
