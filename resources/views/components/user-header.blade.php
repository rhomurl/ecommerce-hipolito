<header class="section-header">
    <section class="header-main border-bottom">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-4">
                    <a href="{{ route('home' )}}" class="brand-wrap">
                        <img class="logo" src="{{ asset('images/logo.png') }}">
                    </a> <!-- brand-wrap.// -->
                </div>
                <div class="col-lg-4">         
                    @livewire('shop.search-bar')
                    {{---search bar here--}}
                </div> <!-- col.// -->
                <div class="col-lg-4 right_side_icons">
                    <div class="widgets-wrap float-md-right">
                        @livewire('components.header-widgets')
                    </div> <!-- widgets-wrap.// -->
                </div> <!-- col.// -->
            </div> <!-- row.// -->
        </div> <!-- container.// -->
    </section> <!-- header-main .// -->
    
    
    <nav class="navbar navbar-main navbar-expand-md border-bottom">
    <div class="container">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main_nav" aria-controls="main_nav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
    
        <div class="collapse navbar-collapse" id="main_nav">
        <ul class="navbar-nav">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#"> <i class="fa fa-bars text-muted mr-2"></i> Categories </a>
                <div class="dropdown-menu dropdown-large">
                    <nav class="row">
                        @livewire('components.header-categories')
                        
                    </nav> <!--  row end .// -->
                </div> <!--  dropdown-menu dropdown-large end.// -->
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('home') }}">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('about') }}">About Us</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('shipping.policy') }}">Shipping Policy</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('faq') }}">FAQ</a>
            </li>
        </ul>
        <ul class="navbar-nav ml-md-auto">
            @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">Sign in</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">Sign up</a>
                </li>
            @endguest

            @auth
            <li class="nav-item">
                <span class="nav-link">Hi, {{ Auth::user()->name }}!</span>
            </li>
            <span class="nav-link">
                <a
                href="{{ route('logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                >
                    Log out
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </span>
            @endauth
        </ul>
        </div> <!-- collapse .// -->
    </div> <!-- container .// -->
    </nav>
    </header> <!-- section-header.// -->

    