<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="pragma" content="no-cache" />
        <meta http-equiv="cache-control" content="max-age=604800" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Primary Meta Tags -->
        @hasSection('title')
        <title>@yield('title') - {{ config('app.name') }}</title>
        @else
        <title>{{ config('app.name') }} — Buy, Pay, and Deliver</title>
        @endif

        <meta name="title" content="Hipolito's Hardware — Buy, Pay, and Deliver">
        <meta name="description" content="With Hipolito's Hardware, you can purchase your desired construction supplies and equipment in just a few clicks. ">

        <!-- Open Graph / Facebook -->
        <meta property="og:type" content="website">
        <meta property="og:url" content="https://hipolito-hardware.herokuapp.com/">
        <meta property="og:title" content="Hipolito's Hardware — Buy, Pay, and Deliver">
        <meta property="og:description" content="With Hipolito's Hardware, you can purchase your desired construction supplies and equipment in just a few clicks. ">
        <meta property="og:image" content="{{ asset('images/thumbnail-meta-tag.jpg') }}">

        <!-- Twitter -->
        <meta property="twitter:card" content="summary_large_image">
        <meta property="twitter:url" content="https://hipolito-hardware.herokuapp.com/">
        <meta property="twitter:title" content="Hipolito's Hardware — Buy, Pay, and Deliver">
        <meta property="twitter:description" content="With Hipolito's Hardware, you can purchase your desired construction supplies and equipment in just a few clicks. ">
        <meta property="twitter:image" content="{{ asset('images/thumbnail-meta-tag.jpg') }}">

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
    
        @include('livewire.components.google-analytics')
    </head>

    <body>     
        <x-user-header/>
        
        @yield('body')
        
        <x-user-footer/>

        @yield('scripts')
        
        @livewireScripts
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="{{ asset('vendor/livewire-alert/livewire-alert.js') }}"></script> 
        <x-livewire-alert::flash />

        @if(App::environment('production'))
            @include('livewire.components.fb-customer-chat')
        @endif
    </body>
</html>
