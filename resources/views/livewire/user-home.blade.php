@section('title', 'Home')
    <!-- BANNER -->
    <section class="section-intro padding-y">
        <div class="container">
        <!-- ==============  COMPONENT SLIDER  BOOTSTRAP ============  -->
        <div id="carousel1_indicator" class="slider-home-banner carousel slide" data-ride="carousel">
          <ol class="carousel-indicators">
            <li data-target="#carousel1_indicator" data-slide-to="0" class="active"></li>
            <li data-target="#carousel1_indicator" data-slide-to="1" class=""></li>
            <li data-target="#carousel1_indicator" data-slide-to="2" class=""></li>
            <li data-target="#carousel1_indicator" data-slide-to="3" class=""></li>
            <li data-target="#carousel1_indicator" data-slide-to="4" class=""></li>
          </ol>
          <div class="carousel-inner">
              @foreach($this->banners as $banner) 
                @if ($loop->first)
                    <div class="carousel-item active">
                    <img src="{{ $this->getProductURL($banner->image) }}" alt="{{ $banner->name }}"> 
                    </div>
                @else

                <div class="carousel-item">
                    <img src="{{ $this->getProductURL($banner->image) }}" alt="{{ $banner->name }}"> 
                </div>
                @endif
            
            @endforeach
            
          </div>
          <a class="carousel-control-prev" href="#carousel1_indicator" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carousel1_indicator" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div> 
        <!-- ============ COMPONENT SLIDER BOOTSTRAP end.// ===========  .// -->	
            
        </div> <!-- container end.// -->
        </section>

    <!-- ========================= SECTION MAIN END// ========================= -->
    
    
    <div class="container">
    
    <!-- =============== SECTION 1 =============== -->
    <section class="padding-bottom">
    <header class="section-heading mb-4">
        <h3 class="title-section">Recommended items</h3>
    </header>
    
    <div class="row">
        @foreach ($this->products as $product)
            @if($product->quantity == 0)
                
            @else
            <div class="col-xl-3 col-lg-3 col-md-4 col-6">
                <div class="card card-product-grid">
                    <a href="{{ route('product.details', $product->slug) }}" class="img-wrap"> <img src="{{ $this->getProductURL($product->image) }}"> </a>
                    <figcaption class="info-wrap">
                        {{--<ul class="rating-stars mb-1">
                            <li style="width:80%" class="stars-active">
                                <img src="images/icons/stars-active.svg" alt="">
                            </li>
                            <li>
                                <img src="images/icons/starts-disable.svg" alt="">
                            </li>
                        </ul>--}}
                        <div>
                            <a href="#" class="text-muted">{{ $product->brand->name }}</a>
                            <a href="{{ route('product.details', $product->slug) }}" class="title">{{ $product->name }}</a>
                        </div>
                        <div class="price h5 mt-2">₱{{ $product->selling_price }}</div> <!-- price.// -->
                        {{--<a wire:click.prevent="addToCart({{$product->id}})" href="#" class="btn btn-primary"> 
                            <i class="fas fa-shopping-cart"></i> <span class="text">Add to cart</span> 
                        </a>--}}
                    </figcaption>
                </div>
            </div> 

            @endif
        @endforeach
        
    </section>
    <!-- =============== SECTION 1 END =============== -->
    
    
    <!-- =============== SECTION BANNER =============== -->
    <section class="padding-bottom">
        <div class="row">
            <aside class="col-md-6">
                <div class="card card-banner-lg bg-dark">
                    <img src="{{ asset('images/plywood-bot-banner.jpg') }}" class="card-img opacity">
                    <div class="card-img-overlay text-white">
                      <h2 class="card-title">Need Plywood For Your House?</h2>
                      <p class="card-text" style="max-width: 80%">There are different plywoods that will suite in your needs!</p>
                      <a href="{{ route('category.search', 'plywood') }}" class="btn btn-light">Discover</a>
                    </div>
                 </div>
            </aside>
            <div class="col-md-6">
                <div class="card card-banner-lg bg-dark">
                    <img src="{{ asset('images/construction-bot-banner.jpg') }}" class="card-img opacity">
                    <div class="card-img-overlay text-white">
                      <h2 class="card-title">Construction Equipments on The Go</h2>
                        <p class="card-text" style="max-width: 80%">Probably equipments you need during construction. Take a look and browse your desired product.</p>
                      <a href="{{ route('category.search', 'construction-equipment') }}" class="btn btn-light">Discover</a>
                    </div>
                 </div>
            </div> <!-- col.// -->
        </div> <!-- row.// -->
    </section>
    <!-- =============== SECTION BANNER .//END =============== -->
    
        
    <!-- =============== SECTION 2 =============== -->
    <section class="padding-bottom">
    
    <header class="section-heading mb-4">
        <h3 class="title-section">New Arrival</h3>
    </header>
    
    <div class="row row-sm">
        @foreach($this->l_products as $l_product)
        <div class="col-xl-2 col-lg-3 col-md-4 col-6">
            <div href="#" class="card card-sm card-product-grid">
                <a href="{{ route('product.details', $l_product->slug) }}" class="img-wrap"> 
                    <b class="badge badge-danger mr-1">10% OFF</b>
                    <img src="{{ $this->getProductURL($l_product->image) }}"> 
                </a>
                <figcaption class="info-wrap">
                    <a href="{{ route('product.details', $l_product->slug) }}" class="title">{{ $l_product->name }}</a>
                    <div class="price-wrap">
                        <span class="price">₱ {{ $l_product->selling_price }}</span>
                        <del class="price-old">₱ {{ ($l_product->selling_price * 0.1) + $l_product->selling_price }}</del>
                    </div> <!-- price-wrap.// -->
                </figcaption>
            </div>
        </div> <!-- col.// -->
        @endforeach
       
       
       
    </div> <!-- row.// -->
    </section>
    <!-- =============== SECTION 2 END =============== -->
    
    
    <!-- =============== SECTION BANNER =============== -->
    <section class="padding-bottom">
        <article class="box d-flex flex-wrap align-items-center p-5 bg-secondary">
            <div class="text-white mr-auto">
                <h3>Want to browse all products? </h3>
                <p>Access all the products you needed</p>
            </div>
            <div class="mt-3 mt-md-0"><a href="{{ route('products.all') }}" class="btn btn-outline-light">All Products</a></div>
        </article>
    </section>
    <!-- =============== SECTION BANNER .//END =============== -->
    
    </div>  
    <!-- container end.// -->