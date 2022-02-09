
  <section class="section-content bg-white padding-y">
    
      
    <div class="container">
    <ol class="breadcrumb p-3">
          <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
          <li class="breadcrumb-item"><a href="#">{{ $this->product->category->name }}</a></li>
          <li class="breadcrumb-item active" aria-current="page">{{ $this->product->name }}</li>
      </ol>
    <!-- ============================ ITEM DETAIL ======================== -->
        <div class="row">
            <aside class="col-md-6">
    <div class="card">
    <article class="gallery-wrap"> 
        <div class="img-big-wrap">
          <div> <a href="#"><img src="{{ asset('storage/') }}/{{$product->image}}"></a></div>
        </div> <!-- slider-product.// -->
        {{--<div class="thumbs-wrap">
          <a href="#" class="item-thumb"> <img src="images/items/15.jpg"></a>
          <a href="#" class="item-thumb"> <img src="images/items/15-1.jpg"></a>
          <a href="#" class="item-thumb"> <img src="images/items/15-2.jpg"></a>
          <a href="#" class="item-thumb"> <img src="images/items/15-1.jpg"></a>
        </div>--}} <!-- slider-nav.// -->
    </article> <!-- gallery-wrap .end// -->
    </div> <!-- card.// -->
            </aside>
            <main class="col-md-6">
    <article class="product-info-aside">
    
    <h2 class="title mt-3">{{ $this->product->name }}</h2>
    
    <div class="rating-wrap my-3">
        <small class="label-rating text-success"> <i class="fa fa-clipboard-check"></i> 999 orders </small>
    </div> <!-- rating-wrap.// -->
    
    <div class="mb-3"> 
        <var class="price h4">₱{{ $this->product->selling_price }}</var> 
        {{--<span class="text-muted">USD 562.65 incl. VAT</span>--}}
    </div> <!-- price-detail-wrap .// -->
    
    <p>Compact sport shoe for running, consectetur adipisicing elit, sed do eiusmod
    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
    consequat. Duis aute irure dolor. Ut enim ad minim veniam,
    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
    consequat </p>
    
    
    <dl class="row">
      <dt class="col-sm-3">Brand</dt>
      <dd class="col-sm-9"><a href="#">{{ $this->product->brand->name }}</a></dd>
    
      <dt class="col-sm-3">Availability</dt>
      <dd class="col-sm-9">In Stock</dd>
    </dl>
    
        <div class="form-row mt-4">
            <div class="form-group col-md flex-grow-0">
                <div class="input-group mb-3 input-spinner">
                  <div class="input-group-append">
                    
                    <button wire:click.prevent="minusQty" {{ $this->qty == 1 ? 'disabled' : '' }} class="btn btn-light" type="button" id="button-minus"> − </button>
                  </div>
                  <input wire:model="qty" type="text" class="form-control">
                  <div class="input-group-prepend">
                    <button wire:click.prevent="addQty" {{ $this->product->quantity <= $this->qty ? 'disabled' : '' }} class="btn btn-light" type="button" id="button-plus"> + </button>
                  </div>
                </div>
            </div> <!-- col.// -->
            @role('customer')
            <div class="form-group col-md">
                <a wire:click.prevent="addToCart('{{ $this->product->id }}', '{{ $this->qty }}')" href="#" class="btn  btn-primary"> 
                    <i class="fas fa-shopping-cart"></i> <span class="text">Add to cart</span> 
                </a>
            </div> <!-- col.// -->
            @endrole
            
        </div> <!-- row.// -->
        <span class="text-warning">
          @if($this->product->quantity <= $this->qty)
            {{ "You have reached the maximum quantity for this product" }}
          @endif
        </span>
    </article> <!-- product-info-aside .// -->
            </main> <!-- col.// -->
        </div> <!-- row.// -->
    
    <!-- ================ ITEM DETAIL END .// ================= -->
    
    
    </div> <!-- container .//  -->
    </section>


    <section class="section-name padding-y bg">
        <div class="container">
        
        <div class="row">
            <div class="col-md-8">
                <h5 class="title-description">Description</h5>
                <p>
                    {{ $this->product->description }}
                </p>
                {{--<ul class="list-check">
                <li>Material: Stainless steel</li>
                <li>Weight: 82kg</li>
                <li>built-in drip tray</li>
                <li>Open base for pots and pans</li>
                <li>On request available in propane execution</li>
                </ul>--}}
        
            </div> <!-- col.// -->
            
            <aside class="col-md-4">
        
                <div class="box">
        
            <h5 class="title-description">Related products</h5>
              
        
            <article class="media mb-3">
              <a href="#"><img class="img-sm mr-3" src="images/posts/3.jpg"></a>
              <div class="media-body">
                <h6 class="mt-0"><a href="#">How to use this item</a></h6>
                <p class="mb-2"> Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin </p>
              </div>
            </article>
        
            <article class="media mb-3">
              <a href="#"><img class="img-sm mr-3" src="images/posts/2.jpg"></a>
              <div class="media-body">
                <h6 class="mt-0"><a href="#">New tips and tricks</a></h6>
                <p class="mb-2"> Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin </p>
              </div>
            </article>
        
            <article class="media mb-3">
              <a href="#"><img class="img-sm mr-3" src="images/posts/1.jpg"></a>
              <div class="media-body">
                <h6 class="mt-0"><a href="#">New tips and tricks</a></h6>
                <p class="mb-2"> Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin </p>
              </div>
            </article>
        
        
                
            </div> <!-- box.// -->
            </aside> <!-- col.// -->
            
            
            <div class="container">
              <br><br>
              <div class="card card-body">
                
                <h5 class="title-description">Related products</h5>
                <div class="row">
                    <div class="col-md-3">
                      <figure class="itemside mb-2">
                        <div class="aside">
                          <a href="#">
                            <img src="{{ asset('storage/') }}/{{$product->image}}" onerror="this.src=''" class="border img-sm">
                          </a>
                          </div>
                        <figcaption class="info align-self-center">
                          <a href="#" class="title">Argentina Corned Beef 150g</a>
                          <strong class="price">₱ 40.00</strong>
                        </figcaption>
                      </figure>
                  </div>

                  <div class="col-md-3">
                    <figure class="itemside mb-2">
                      <div class="aside">
                        <a href="#">
                          <img src="{{ asset('storage/') }}/{{$product->image}}" onerror="this.src=''" class="border img-sm">
                        </a>
                        </div>
                      <figcaption class="info align-self-center">
                        <a href="#" class="title">Argentina Corned Beef 150g</a>
                        <strong class="price">₱ 40.00</strong>
                      </figcaption>
                    </figure>
                </div>

                <div class="col-md-3">
                  <figure class="itemside mb-2">
                    <div class="aside">
                      <a href="#">
                        <img src="{{ asset('storage/') }}/{{$product->image}}" onerror="this.src=''" class="border img-sm">
                      </a>
                      </div>
                    <figcaption class="info align-self-center">
                      <a href="#" class="title">Argentina Corned Beef 150g</a>
                      <strong class="price">₱ 40.00</strong>
                    </figcaption>
                  </figure>
              </div>

              <div class="col-md-3">
                <figure class="itemside mb-2">
                  <div class="aside">
                    <a href="#">
                      <img src="{{ asset('storage/') }}/{{$product->image}}" onerror="this.src=''" class="border img-sm">
                    </a>
                    </div>
                  <figcaption class="info align-self-center">
                    <a href="#" class="title">Argentina Corned Beef 150g</a>
                    <strong class="price">₱ 40.00</strong>
                  </figcaption>
                </figure>
            </div>

            



                </div> <!-- row.// -->
              </div>
            </div>


        </div> <!-- row.// -->
        
        </div> <!-- container .//  -->
        </section>
  
