<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet">

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
        <link href="{{ asset("css/ui_v2.css") }}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('css/responsive.css') }}" rel="stylesheet" type="text/css" />
        
        @livewireStyles

        <!-- custom javascript -->
        <script src="{{ asset('dashboard/assets/js/init-alpine.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js" defer></script>
        <script src="{{ asset('js/script.js') }}" type="text/javascript"></script>


    </head>
    <x-user-header/>
    <section class="section-content padding-y">
        <div class="container text-center">
        
        <header class="section-heading ">
            <h2 class="section-title">@yield('code')</h2>
        </header><!-- sect-heading -->
        
        <article>
        
        
        <p>@yield('message')</p>
        
        <a href="{{ route('home') }}" class="btn btn-primary"> 
            <i class="fas fa-home"></i> <span class="text">Return Home</span> 
          </a>
      
        </article>
        
        </div> <!-- container .//  -->
        </section>  
</html>

