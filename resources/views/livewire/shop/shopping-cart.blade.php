
<div class="container">
    <br><br>
    <div class="row">
        
    <main class="col-md-9">
        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif

        @if($this->checkout_message)
            <div class="alert alert-warning">
                {{ $this->checkout_message }}
            </div>
        @endif
    <div class="card">
        
        <table class="table table-borderless table-shopping-cart">
        <thead class="text-muted">
        @if(!$cartItems->count() == 0)
            <tr class="small text-uppercase">
            <th scope="col">Product</th>
            <th scope="col" width="150">Quantity</th>
            <th scope="col" width="120">Price</th>
            <th scope="col" class="text-right" width="200"> </th>
            </tr>
        @endif
        </thead>
        <tbody>
        @forelse ($cartItems as $cartItem)
            <tr>
                <td>
                    <figure class="itemside">
                        <div class="aside">
                            <a href="{{ route('product.details', $cartItem->slug ) }}">
                            <img src="{{ $this->getProductURL($cartItem->image) }}" onerror="this.src='{{ asset('storage/app/public/') }}/{{ $cartItem->image }}'" class="img-sm">
                            </a>
                        </div>
                        <figcaption class="info">
                            <a href="{{ route('product.details', $cartItem->slug ) }}" class="title text-dark">{{ $cartItem->name }}</a>
                            <p class="text-muted small">{{--Size: XL, Color: blue, <br>--}}Brand: {{ $cartItem->brand }}</p>
                        </figcaption>
                    </figure>
                </td>
                <td> 
                    
                    <div class="form-inline">
                        @if($cartItem->quantity > $cartItem->qty)
                        <button wire:click.prevent="decreaseQuantity({{ $cartItem->id }}, {{$cartItem->qty }})" type="submit" class="btn btn-sm btn-light mr-2">-</button>
                            {{ $cartItem->qty }}
                        <button wire:click.prevent="increaseQuantity({{ $cartItem->id }})" type="submit" class="btn btn-sm btn-light ml-2">+</button>
                        @else
                            Out of stock
                        @endif
                    </div>
                </td>
                <td> 
                    <div class="price-wrap"> 
                        <var class="price">₱ {{ $cartItem->selling_price * $cartItem->qty }}</var> 
                        <small class="text-muted">₱ {{ $cartItem->selling_price }}  </small> 
                    </div> <!-- price-wrap .// -->
                </td>
                <td class="text-right"> 
                <a wire:click.prevent="removefromCart({{$cartItem->id }})" href="" class="btn btn-light"> Remove</a>
                </td>
            </tr>
        @empty
            <tr >
                <td colspan="4">No items in cart</td>
            </tr>

        @endforelse

        </tbody>
        </table>

            <div class="card-body border-top">
                <a href="{{ url()->previous() }}" class="btn btn-light"> <i class="fa fa-chevron-left"></i> Continue shopping </a>
            </div>	
    </div> <!-- card.// -->

    <div class="alert alert-success mt-3">
        <p class="icontext"><i class="icon text-success fa fa-truck"></i> Free Shipping for Orders Above 2500 PHP</p>
    </div>

    </main> <!-- col.// -->
        <aside class="col-md-3">
            
            <div class="card">
                <div class="card-body">
                        <dl class="dlist-align">
                            <dt>Subtotal:</dt>
                            <dd class="text-right">₱ {{ $totalCart }}.00</dd>
                        </dl>
                        <dl class="dlist-align">
                            <dt>Shipping:</dt>
                            <dd class="text-right"> Computed at checkout</dd>
                        </dl>
                        <hr>
                        <p class="text-center mb-3">
                            <img src="{{ asset("images/misc/payment-paypal.png") }}">
                            <img src="{{ asset("images/misc/cod_payment.jpg") }}" height="50%" width="50%">
                        </p>
                        
                </div> <!-- card-body.// -->
            </div>  <!-- card .// -->
            <div class="card mb-3">
                <div class="card-body">
                <form>
                    <div class="form-group">
                        @if(count($cartItems) > 0)
                            <a wire:click.prevent="setAmountForCheckout()" href="#" class="btn btn-primary btn-block"> Checkout <i class="fa fa-chevron-right"></i> </a>
                        @else
                            <a href="#" class="btn btn-secondary btn-block disabled"> Checkout <i class="fa fa-chevron-right"></i> </a>
                        @endif
                        </div>
                    </div>
                </form>
                </div> <!-- card-body.// -->
            </div>  <!-- card .// -->
        </aside> <!-- col.// -->
    </div>
</div> <!-- container .//  -->
