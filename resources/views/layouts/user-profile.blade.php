@extends('layouts.base')

@section('body')
    <section class="section-pagetop bg-gray">
        <div class="container">
            <h2 class="title-page">@yield('title')</h2>
        </div> <!-- container //  -->
    </section>

    
    <section class="section-content padding-y">
        <div class="container">
        
        <div class="row">
            <aside class="col-md-3">
                <nav class="list-group">
                    <a class="list-group-item {{ \Route::current()->getName() == 'user.overview' ? 'active' : '' }}" href="{{ route('user.overview') }}"> Account overview  </a>
                    <a class="list-group-item {{ \Route::current()->getName() == 'user.address' ? 'active' : '' }}" href="{{ route('user.address') }}"> My Address </a>
                    <a class="list-group-item {{ \Route::current()->getName() == 'user.orders' ? 'active' : '' }}" href="{{ route('user.orders') }}"> My Orders </a>
                    <a class="list-group-item {{ \Route::current()->getName() == 'user.wishlists' ? 'active' : '' }}" href="{{ route('user.wishlists') }}"> My Wishlists </a>
                    <a class="list-group-item" href="page-profile-setting.html"> Settings </a>
                    <a class="list-group-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> Log out </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>

                </nav>
            </aside> <!-- col.// -->
            <main class="col-md-9">
        
                <article class="card mb-3">
                    @yield('content')
                </article> <!-- card.// -->
        
            </main> <!-- col.// -->
        </div>
        
        </div> <!-- container .//  -->
        </section>

        @isset($slot)
            {{ $slot }}
        @endisset
    
@endsection
