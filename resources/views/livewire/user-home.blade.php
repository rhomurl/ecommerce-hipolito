@section('title', 'Home')


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
                    <a href="{{ route('product.details', $product->slug) }}" class="img-wrap"> <img src="{{ asset('storage/') }}/{{ $product->image }}"> </a>
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
                        <a wire:click.prevent="addToCart({{$product->id}})" href="#" class="btn btn-primary"> 
                            <i class="fas fa-shopping-cart"></i> <span class="text">Add to cart</span> 
                        </a>
                    </figcaption>
                </div>
            </div> 

            @endif
        @endforeach
        

        {{----2ND ROW-----}}
        <div class="col-xl-3 col-lg-3 col-md-4 col-6">
            <div class="card card-product-grid">
                <a href="#" class="img-wrap"> <img src="images/items/5.jpg"> </a>
                <figcaption class="info-wrap">
                    <ul class="rating-stars mb-1">
                        <li style="width:80%" class="stars-active">
                            <img src="images/icons/stars-active.svg" alt="">
                        </li>
                        <li>
                            <img src="images/icons/starts-disable.svg" alt="">
                        </li>
                    </ul>
                    <div>
                        <a href="#" class="text-muted">Luxury</a>
                        <a href="#" class="title">Leather Wallet Brown Style</a>
                    </div>
                    <div class="price h5 mt-2">$56</div> <!-- price.// -->
                </figcaption>
            </div>
        </div> <!-- col.// -->
        <div class="col-xl-3 col-lg-3 col-md-4 col-6">
            <div class="card card-product-grid">
                <a href="#" class="img-wrap"> <img src="images/items/6.jpg"> </a>
                <figcaption class="info-wrap">
                    <ul class="rating-stars mb-1">
                        <li style="width:80%" class="stars-active">
                            <img src="images/icons/stars-active.svg" alt="">
                        </li>
                        <li>
                            <img src="images/icons/starts-disable.svg" alt="">
                        </li>
                    </ul>
                    <div>
                        <a href="#" class="text-muted">Interior</a>
                        <a href="#" class="title">Sofa for Minimalist Interior</a>
                    </div>
                    <div class="price h5 mt-2">$56</div> <!-- price.// -->
                </figcaption>
            </div>
        </div> <!-- col.// -->
        <div class="col-xl-3 col-lg-3 col-md-4 col-6">
            <div class="card card-product-grid">
                <a href="#" class="img-wrap"> <img src="images/items/7.jpg"> </a>
                <figcaption class="info-wrap">
                    <ul class="rating-stars mb-1">
                        <li style="width:80%" class="stars-active">
                            <img src="images/icons/stars-active.svg" alt="">
                        </li>
                        <li>
                            <img src="images/icons/starts-disable.svg" alt="">
                        </li>
                    </ul>
                    <div>
                        <a href="#" class="text-muted">Clothes</a>
                        <a href="#" class="title">Amazing item name comes here</a>
                    </div>
                    <div class="price h5 mt-2">$56</div> <!-- price.// -->
                </figcaption>
            </div>
        </div> <!-- col.// -->
        <div class="col-xl-3 col-lg-3 col-md-4 col-6">
            <div class="card card-product-grid">
                <a href="#" class="img-wrap"> <img src="images/items/8.jpg"> </a>
                <figcaption class="info-wrap">
                    <ul class="rating-stars mb-1">
                        <li style="width:80%" class="stars-active">
                            <img src="images/icons/stars-active.svg" alt="">
                        </li>
                        <li>
                            <img src="images/icons/starts-disable.svg" alt="">
                        </li>
                    </ul>
                    <div>
                        <a href="#" class="text-muted">Clothes</a>
                        <a href="#" class="title">Great product name is here</a>
                    </div>
                    <div class="price h5 mt-2">$56</div> <!-- price.// -->
                </figcaption>
            </div>
        </div> <!-- col.// -->
        <div class="col-xl-3 col-lg-3 col-md-4 col-6">
            <div class="card card-product-grid">
                <a href="#" class="img-wrap"> <img src="images/items/1.jpg"> </a>
                <figcaption class="info-wrap">
                    <ul class="rating-stars mb-1">
                        <li style="width:80%" class="stars-active">
                            <img src="images/icons/stars-active.svg" alt="">
                        </li>
                        <li>
                            <img src="images/icons/starts-disable.svg" alt="">
                        </li>
                    </ul>
                    <div>
                        <a href="#" class="text-muted">Clothes</a>
                        <a href="#" class="title">Men's T-shirt for summer</a>
                    </div>
                    <div class="price h5 mt-2">$99</div> <!-- price.// -->
                </figcaption>
            </div>
        </div> <!-- col.// -->
        <div class="col-xl-3 col-lg-3 col-md-4 col-6">
            <div class="card card-product-grid">
                <a href="#" class="img-wrap"> <img src="images/items/2.jpg"> </a>
                <figcaption class="info-wrap">
                    <ul class="rating-stars mb-1">
                        <li style="width:80%" class="stars-active">
                            <img src="images/icons/stars-active.svg" alt="">
                        </li>
                        <li>
                            <img src="images/icons/starts-disable.svg" alt="">
                        </li>
                    </ul>
                    <div>
                        <a href="#" class="text-muted">Clothes</a>
                        <a href="#" class="title">Winter Jacket for Men, All sizes</a>
                    </div>
                    <div class="price h5 mt-2">$19</div> <!-- price.// -->
                </figcaption>
            </div>
        </div> <!-- col.// -->
        <div class="col-xl-3 col-lg-3 col-md-4 col-6">
            <div class="card card-product-grid">
                <a href="#" class="img-wrap"> <img src="images/items/3.jpg"> </a>
                <figcaption class="info-wrap">
                    <ul class="rating-stars mb-1">
                        <li style="width:80%" class="stars-active">
                            <img src="images/icons/stars-active.svg" alt="">
                        </li>
                        <li>
                            <img src="images/icons/starts-disable.svg" alt="">
                        </li>
                    </ul>
                    <div>
                        <a href="#" class="text-muted">Clothes</a>
                        <a href="#" class="title">Jeans Shorts for Boys Small size</a>
                    </div>
                    <div class="price h5 mt-2">$56</div> <!-- price.// -->
                </figcaption>
            </div>
        </div> <!-- col.// -->
        <div class="col-xl-3 col-lg-3 col-md-4 col-6">
            <div class="card card-product-grid">
                <a href="#" class="img-wrap"> <img src="images/items/8.jpg"> </a>
                <figcaption class="info-wrap">
                    <ul class="rating-stars mb-1">
                        <li style="width:80%" class="stars-active">
                            <img src="images/icons/stars-active.svg" alt="">
                        </li>
                        <li>
                            <img src="images/icons/starts-disable.svg" alt="">
                        </li>
                    </ul>
                    <div>
                        <a href="#" class="text-muted">Clothes</a>
                        <a href="#" class="title">Great product name is here</a>
                    </div>
                    <div class="price h5 mt-2">$56</div> <!-- price.// -->
                </figcaption>
            </div>
        </div> <!-- col.// -->
    </div> <!-- row.// -->
    </section>
    <!-- =============== SECTION 1 END =============== -->
    
    
    <!-- =============== SECTION BANNER =============== -->
    <section class="padding-bottom">
        <div class="row">
            <aside class="col-md-6">
                <div class="card card-banner-lg bg-dark">
                    <img src="images/banners/banner4.jpg" class="card-img opacity">
                    <div class="card-img-overlay text-white">
                      <h2 class="card-title">Big Deal on Clothes</h2>
                      <p class="card-text" style="max-width: 80%">This is a wider card with text below and Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illo ab quae nihil praesentium impedit libero possimus id vero</p>
                      <a href="#" class="btn btn-light">Discover</a>
                    </div>
                 </div>
            </aside>
            <div class="col-md-6">
                <div class="card card-banner-lg bg-dark">
                    <img src="images/banners/banner5.jpg" class="card-img opacity">
                    <div class="card-img-overlay text-white">
                      <h2 class="card-title">Great Bundle for You</h2>
                        <p class="card-text" style="max-width: 80%">Card with text below and Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illo ab quae nihil praesentium impedit libero possimus id vero</p>
                      <a href="#" class="btn btn-light">Discover</a>
                    </div>
                 </div>
            </div> <!-- col.// -->
        </div> <!-- row.// -->
    </section>
    <!-- =============== SECTION BANNER .//END =============== -->
    
        
    <!-- =============== SECTION 2 =============== -->
    <section class="padding-bottom">
    
    <header class="section-heading mb-4">
        <h3 class="title-section">Daily deals</h3>
    </header>
    
    <div class="row row-sm">
        <div class="col-xl-2 col-lg-3 col-md-4 col-6">
            <div href="#" class="card card-sm card-product-grid">
                <a href="#" class="img-wrap"> 
                    <b class="badge badge-danger mr-1">10% OFF</b>
                    <img src="images/items/9.jpg"> 
                </a>
                <figcaption class="info-wrap">
                    <a href="#" class="title">Just another product name</a>
                    <div class="price-wrap">
                        <span class="price">$45</span>
                        <del class="price-old">$90</del>
                    </div> <!-- price-wrap.// -->
                </figcaption>
            </div>
        </div> <!-- col.// -->
        <div class="col-xl-2 col-lg-3 col-md-4 col-6">
            <div href="#" class="card card-sm card-product-grid">
                <a href="#" class="img-wrap"> 
                    <b class="badge badge-danger mr-1">85% OFF</b>
                    <img src="images/items/10.jpg">
                </a>
                <figcaption class="info-wrap">
                    <a href="#" class="title">Some item name here</a>
                    <div class="price-wrap">
                        <span class="price">$45</span>
                        <del class="price-old">$90</del>
                    </div> <!-- price-wrap.// -->
                </figcaption>
            </div>
        </div> <!-- col.// -->
        <div class="col-xl-2 col-lg-3 col-md-4 col-6">
            <div href="#" class="card card-sm card-product-grid">
                <a href="#" class="img-wrap"> 
                    <b class="badge badge-danger mr-1">10% OFF</b>
                    <img src="images/items/11.jpg">
                </a>
                <figcaption class="info-wrap">
                    <a href="#" class="title">Great product name here</a>
                    <div class="price-wrap">
                        <span class="price">$45</span>
                        <del class="price-old">$90</del>
                    </div> <!-- price-wrap.// -->
                </figcaption>
            </div>
        </div> <!-- col.// -->
        <div class="col-xl-2 col-lg-3 col-md-4 col-6">
            <div href="#" class="card card-sm card-product-grid">
                <a href="#" class="img-wrap"> 
                    <b class="badge badge-danger mr-1">90% OFF</b>
                    <img src="images/items/12.jpg"> 
                </a>
                <figcaption class="info-wrap">
                    <a href="#" class="title">Just another product name</a>
                    <div class="price-wrap">
                        <span class="price">$45</span>
                        <del class="price-old">$90</del>
                    </div> <!-- price-wrap.// -->
                </figcaption>
            </div>
        </div> <!-- col.// -->
        <div class="col-xl-2 col-lg-3 col-md-4 col-6">
            <div href="#" class="card card-sm card-product-grid">
                <a href="#" class="img-wrap"> 
                    <b class="badge badge-danger mr-1">20% OFF</b>
                    <img src="images/items/5.jpg"> 
                </a>
                <figcaption class="info-wrap">
                    <a href="#" class="title">Just another product name</a>
                    <div class="price-wrap">
                        <span class="price">$45</span>
                        <del class="price-old">$90</del>
                    </div> <!-- price-wrap.// -->
                </figcaption>
            </div>
        </div> <!-- col.// -->
        <div class="col-xl-2 col-lg-3 col-md-4 col-6">
            <div href="#" class="card card-sm card-product-grid">
                <a href="#" class="img-wrap"> 
                    <b class="badge badge-danger mr-1">20% OFF</b>
                    <img src="images/items/6.jpg">
                </a>
                <figcaption class="info-wrap">
                    <a href="#" class="title">Some item name here</a>
                    <div class="price-wrap">
                        <span class="price">$45</span>
                        <del class="price-old">$90</del>
                    </div> <!-- price-wrap.// -->
                </figcaption>
            </div>
        </div> <!-- col.// -->
    </div> <!-- row.// -->
    </section>
    <!-- =============== SECTION 2 END =============== -->
    
    
    <!-- =============== SECTION BANNER =============== -->
    <section class="padding-bottom">
        <article class="box d-flex flex-wrap align-items-center p-5 bg-secondary">
            <div class="text-white mr-auto">
                <h3>Looking for fashion? </h3>
                <p> Popular items, discounts and free shipping </p>
            </div>
            <div class="mt-3 mt-md-0"><a href="" class="btn btn-outline-light">Learn more</a></div>
        </article>
    </section>
    <!-- =============== SECTION BANNER .//END =============== -->
    
    </div>  
    <!-- container end.// -->
