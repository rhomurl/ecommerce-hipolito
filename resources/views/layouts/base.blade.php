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
        <link href="{{ asset("css/ui.css") }}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('css/responsive.css') }}" rel="stylesheet" type="text/css" />
        
        @yield('style')

        @livewireStyles

        <!-- custom javascript -->
        <script src="{{ asset('dashboard/assets/js/init-alpine.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js" defer></script>
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
        <meta name="csrf-token" content="{{ csrf_token() }}" />
    </head>

    <body>
        
        <!-- ========================= FOOTER ========================= -->
        <x-user-header/>
        <!-- ========================= FOOTER END // ========================= -->
            
        <!-- ========================= SECTION MAIN  ========================= -->
        @yield('body')
        <!-- ========================= SECTION END // ========================= -->
    
        <!-- ========================= FOOTER ========================= -->
        <x-user-footer/>
        <!-- ========================= FOOTER END // ========================= -->
        
        
        @yield('scripts')
        
        
        @livewireScripts
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="{{ asset('vendor/livewire-alert/livewire-alert.js') }}"></script> 
        <x-livewire-alert::flash />
      
        
    </body>
</html>
