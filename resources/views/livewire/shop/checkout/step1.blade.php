<div class="container mt-5" style="max-width:720px;">
    <form wire:submit.prevent="placeOrder">
    <div class="card">
        @if($this->checkout_message)
    <div class="alert alert-danger" role="alert">
        {{ $this->checkout_message}}
    </div>
    @endif
        <div class="card-body">
            <h4 class="card-title">Address</h4>
        @forelse($addresses as $address)
            
            <input wire:model="address_book_id" type="radio" value="{{ $address->id }}">
            <label for="address">{{ $address->entry_street_address }}, 
            {{ $address->barangay->name }},
            {{ $address->barangay->city->name }},  
            {{ $address->barangay->city->zip }}</label>
            @if($address->id == auth()->user()->address_book_id)
                <b>{{ $this->msg_add_default }}</b>
            @endif
            <br>
        @empty
    
        No address. Add an address?
        <a href="{{ route('user.address.create')}}" class="btn btn-light mb-3"> <i class="fa fa-plus"></i> Add new address </a>
        @endforelse
        </div>
    </div>

    <div class="card mt-3">
        <h4 class="card-title ml-3 mt-3">Products</h4>

            <table class="table table-borderless table-shopping-cart">
            <thead class="text-muted">
            @if(!$cartItems->count() == 0)
                <tr class="small text-uppercase">
                <th scope="col" width="240">Product</th>
                <th scope="col" width="120">Quantity</th>
                <th scope="col" width="120">Price</th>
                </tr>
            @endif
            </thead>
            <tbody>
            @foreach ($cartItems as $cartItem)
                <tr>
                    <td>
                        <figure class="itemside">
                            <div class="aside">
                                <a href="#">
                                <img src="{{ $this->getProductURL($cartItem->image) }}" onerror="this.src='{{ asset('storage/app/public/') }}/{{ $cartItem->image }}'" class="img-sm">
                                </a>
                            </div>
                            <figcaption class="info">
                                <a href="#" class="title text-dark">{{ $cartItem->name }}</a>
                                <p class="text-muted small">{{--Size: XL, Color: blue, <br>--}}Brand: {{ $cartItem->brand }}</p>
                            </figcaption>
                        </figure>
                    </td>
                    <td> 
                        <div class="form-inline">
                            {{ $cartItem->qty }}
                        </div>
                    </td>
                    <td> 
                        <div class="price-wrap"> 
                            <var class="price">₱ {{ $cartItem->selling_price * $cartItem->qty }}</var> 
                            <small class="text-muted">₱ {{ $cartItem->selling_price }}  </small> 
                        </div> <!-- price-wrap .// -->
                    </td>
                    
                </tr>
            @endforeach

            </tbody>
            </table>
            
        </div> <!-- card.// -->
        <br>
        <article class="accordion" id="accordion_pay">
            <div class="card">
                <h4 class="card-title ml-3 mt-3">Payment Method</h4>
                <header class="card-header">
                    <img src="{{ asset('images/misc/paypal_cc_payment.png') }}" class="float-right" height="24"> 
                    <label class="form-check collapsed" data-toggle="collapse" data-target="#pay_paynet" aria-expanded="false">
                        <input wire:model="payment_mode" value="paypal" type="radio" name="payment_mode" class="form-check-input">
                        <h6 class="form-check-label"> 
                            PayPal/Credit Card
                        </h6>
                    </label>
                </header>
                
                <div id="pay_paynet" class="collapse" data-parent="#accordion_pay" style="">
                <div class="card-body">
                    <p class="text-center text-muted">Connect your PayPal account and use it to pay your order. You'll be redirected to PayPal to add your billing information.</p>
                </div> <!-- card body .// -->
                </div> <!-- collapse .// -->
            </div> <!-- card.// -->
    
            <div class="card">
                <header class="card-header">
                    <img src="{{ asset('images/misc/cod_payment.jpg') }}" class="float-right" height="36"> 
                    <label class="form-check collapsed" data-toggle="collapse" data-target="#pay_cod" aria-expanded="false">
                        <input wire:model="payment_mode" value="cod" type="radio" name="payment_mode" class="form-check-input">
                        <h6 class="form-check-label"> 
                            Cash on Delivery 
                        </h6>
                    </label>
                </header>
                <div id="pay_cod" class="collapse" data-parent="#accordion_pay" style="">
                <div class="card-body">
                    <p class="text-center text-muted">Payment will be given upon delivery.</p>
                </div> <!-- card body .// -->
                </div> <!-- collapse .// -->
            </div> <!-- card.// -->     
            <button class="btn btn-primary float-md-right"> Place Order <i class="fa fa-chevron-right"></i> </button>
        </article>
        
    </form>
</div>