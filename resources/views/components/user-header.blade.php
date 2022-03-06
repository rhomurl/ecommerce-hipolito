<header class="section-header">

    <nav class="navbar d-none d-md-flex p-md-0 navbar-expand-sm navbar-light border-bottom">
    <div class="container">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTop4" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarTop4">
        <ul class="navbar-nav mr-auto">
            
              @auth
              <li><span class="nav-link">Hi, 
                {{ Auth::user()->name }}    
              </span></li>

              <li><span class="nav-link">
                <a
                href="{{ route('logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                >
                    Log out
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
              </span></li>
              @else
              <li><span class="nav-link">
                <a href="{{ route('login') }}"> Sign in </a> or <a href="{{ route('register') }}"> Register </a>
              </span></li>
              @endauth
            
              

              <li><a href="#" class="nav-link"> Sell </a></li>
            <li><a href="#" class="nav-link"> Help </a></li>
        </ul>
        <ul class="navbar-nav">
            <li><a href="#" class="nav-link"> <img src="{{ asset('images/icons/flags/US.png') }}" height="16"> Ship to </a></li>
            <li><a href="{{ route('user.overview') }}" class="nav-link"> Profile </a></li>
            <li><a href="{{ route('user.orders') }}" class="nav-link"> Orders </a></li>
            <li><a href="#" class="nav-link"> <i class="fa fa-bell"></i> </a></li>
            <li><a href="{{ route('cart') }}" class="nav-link"> <i class="fa fa-shopping-cart"></i> </a></li>
        </ul> <!-- list-inline //  -->
      </div> <!-- navbar-collapse .// -->
    </div> <!-- container //  -->
    </nav>
    
    <div class="container">
    <section class="header-main border-bottom">
    <div class="row row-sm">
        <div class="col-6 col-sm col-md col-lg  flex-grow-0">
            <a href="{{ route('home') }}" class="brand-wrap">
                <img class="logo" src="{{ asset('images/logo.png') }}">
            </a> <!-- brand-wrap.// -->
        </div>
        <div class="col-6 col-sm col-md col-lg flex-md-grow-0">
    
            <!-- mobile-only -->
            <div class="d-md-none float-right">
                <a href="#" class="btn btn-light"> <i class="fa fa-bell"></i> </a>
                <a href="#" class="btn btn-light"> <i class="fa fa-user"></i> </a>
                <a href="#" class="btn btn-light"> <i class="fa fa-shopping-cart"></i> 2 </a>
            </div>
            <!-- mobile-only //end  -->
    
        
        </div> <!-- col.// -->
        
      @livewire('shop.search-bar')

      
        {{---search bar here--}}
    </div> <!-- row.// -->
    </section> <!-- header-main .// -->
    
    
    <nav class="navbar navbar-main navbar-expand pl-0">
          <ul class="navbar-nav flex-wrap">
              <li class="nav-item">
               <a class="nav-link" href="#">Home</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#"> Demo pages </a>
                <div class="dropdown-menu dropdown-large">
                    <nav class="row">
                        <div class="col-6">
                            <a href="page-index-1.html">Home page 1</a>
                            <a href="page-index-2.html">Home page 2</a>
                            <a href="page-category.html">All category</a>
                            <a href="page-listing-large.html">Listing list</a>
                            <a href="page-listing-grid.html">Listing grid</a>
                            <a href="page-shopping-cart.html">Shopping cart</a>
                            <a href="page-detail-product.html">Product detail</a>
                            <a href="page-content.html">Page content</a>
                            <a href="page-user-login.html">Page login</a>
                            <a href="page-user-register.html">Page register</a>
                        </div>
                        <div class="col-6">
                            <a href="page-profile-main.html">Profile main</a>
                            <a href="page-profile-orders.html">Profile orders</a>
                            <a href="page-profile-seller.html">Profile seller</a>
                            <a href="page-profile-wishlist.html">Profile wishlist</a>
                            <a href="page-profile-setting.html">Profile setting</a>
                            <a href="page-profile-address.html">Profile address</a>
                            <a href="page-components.html" target="_blank">More components</a>
                        </div>
                    </nav> <!--  row end .// -->
                </div> <!--  dropdown-menu dropdown-large end.// -->
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Electronics</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Fashion</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Beauty</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Motors</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Sports</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Gardening</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Deals</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Under $10</a>
            </li>
          </ul>
    </nav> <!-- navbar-main  .// -->
    
    </div> <!-- container.// -->
    </header>