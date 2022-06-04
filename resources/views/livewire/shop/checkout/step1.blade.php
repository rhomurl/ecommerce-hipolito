@section('style')
    <link href="{{ asset('css/checkout.css' ) }}" rel="stylesheet">
@endsection

<section>
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-lg-8">
                <article class="card checkout_card">
                    
                    
                    <div class="card-body checkout_card_body">
                        @if($this->error_message)
                            {{ $this->error_message }}
                        @endif
                        
                        @if($this->showForm == false)
                            <form wire:submit.prevent="placeOrder">
                        @endif
                        <h5 class="card-title checkout_card_title">Shipping Info</h5>
                        
                        @forelse($addresses as $address)
                            
                            <label for="address" class="form-check checkout_form_check">
                            <input wire:model="address_book_id" value="{{ $address->id }}" type="radio" name="address" >
                            
                            {{ $address->entry_street_address }}, 
                            {{ $address->barangay->name }},
                            {{ $address->barangay->city->name }},  
                            {{ $address->barangay->city->zip }}
                            @if($address->id == auth()->user()->address_book_id)
                            — <b>{{ $this->msg_add_default }}</b> 
                            @endif
                            [<a href="{{ route('user.address.edit', $address->id)}}">Edit</a>]&nbsp;
                            [<a href="#" wire:click.prevent="deleteAddr({{$address->id}})">Delete</a>]
                            </label>
                       
                        <br>
                        
                    @empty

                        No address. Add an address?
                        {{--<a href="{{ route('user.address.create')}}" class="btn btn-light mb-3"> <i class="fa fa-plus"></i> Add new address </a>--}}
                    @endforelse

                    <button wire:click.prevent="showAddr" type="submit" class="btn btn-primary">Add Address</button>
                    

                        @if($this->showForm == true && $this->addr_count == 0)
                        <hr>
                        <h5 class="card-title checkout_card_title">Shipping Info</h5>
                        <form wire:submit.prevent="storeAddress">
                        <div class="row">
                            <div class="col-6 mb-3">
                                <label class="form-label checkout_form_label" for="">First Name</label>
                                <input wire:model.lazy="entry_firstname" class="form-control" type="text" placeholder="Enter first name" required>
                                @error('entry_firstname')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label class="form-label checkout_form_label" for="">Last Name</label>
                                <input wire:model.lazy="entry_lastname" class="form-control" type="text" placeholder="Enter last name" required>
                                @error('entry_lastname')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label class="form-label checkout_form_label" for="">Company</label>
                                <input wire:model.lazy="entry_company" class="form-control" type="text" placeholder="Enter company">
                                @error('entry_company')
                                <span class="text-danger">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label class="form-label checkout_form_label" for="">Landmark</label>
                                <input wire:model.lazy="entry_landmark" class="form-control" type="text" placeholder="Enter landmark">
                                @error('entry_landmark')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="col-lg-12 mb-3">
                                <label class="form-label checkout_form_label" for="">Street Address</label>
                                <input wire:model.lazy="entry_street_address" class="form-control" type="text" placeholder="Enter street address" required>
                                @error('entry_street_address')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="col-sm-4 mb-3">
                                <label class="form-label checkout_form_label">City</label>
                                <select wire:model="city" name="city" class="form-control" required>
                                    <option value="">-- choose city --</option>
                                    @foreach ($cities as $city)
                                        <option value="{{ $city->id }}">{{ $city->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-4 mb-3">
                                <label class="form-label checkout_form_label">Barangay</label>
                                <select wire:model="barangay" name="barangay" class="form-control" required>
                                    @if ($barangays->count() == 0)
                                        <option value="">-- choose city first --</option>
                                    @endif
                                    @foreach ($barangays as $barangay)
                                        <option value="{{ $barangay->id }}">{{ $barangay->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-4 mb-3">
                                <label class="form-label checkout_form_label" for="">Phone number</label>
                                <input wire:model.lazy="entry_phonenumber" class="form-control" type="text" placeholder="Enter phone number">
                                @error('entry_phonenumber')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <hr class="my-4">
                        
                    
                        <label class="form-check mb-4 checkout_form_check">
                            <input wire:model="setAddr" value="1" class="form-check-input" type="checkbox">
                            <span class="form-check-label">Set as default</span>
                        </label>
                        <button type="submit" class="btn btn-primary">Continue</button>
                        <button wire:click.prevent="cancel" type="submit" class="btn btn-light">Cancel</button> 
                        </form>
                       @endif
                   
                    </div>
                </article>

                @if($this->showForm == false)
                    <article class="card">
                        <div class="card-body">
                        <h5 class="card-title checkout_card_title">Shipping type</h5>
                        <div class="row mb-3">
                            <div class="col-lg-6 mb-3">
                                <div class="box box-check checkout_box">
                                    <label class="form-check checkout_form_check">
                                        <input wire:model="shipping_type" value="express" class="form-check-input" type="radio">
                                        <b class="border-oncheck"></b>
                                        <span class="form-check-label">
                                            "Express delivery"
                                            <br>
                                            <small class="text-muted">Within the day delivery</small>
                                        </span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-6 mb-3">
                                <div class="box box-check checkout_box">
                                    <label class="form-check checkout_form_check">
                                        <input wire:model="shipping_type" value="standard" class="form-check-input" type="radio">
                                        <b class="border-oncheck"></b>
                                        <span class="form-check-label">
                                            "Standard delivery"
                                            <br>
                                            <small class="text-muted">Delivery tomorrow</small>
                                        </span>
                                    </label>
                                </div>
                            </div>
                            {{--<div class="col-lg-4 mb-3">
                                <div class="box box-check checkout_box">
                                    <label class="form-check checkout_form_check">
                                        <input class="form-check-input" type="radio">
                                        <b class="border-oncheck"></b>
                                        <span class="form-check-label">
                                            "Self pick-up"
                                            <br>
                                            <small class="text-muted">Come to our shop</small>
                                        </span>
                                    </label>
                                </div>
                            </div>--}}
                        </div>
                        </div>
                    </article>
                    <article class="card">
                        <div class="card-body">
                            <h5 class="card-title">Payment Method</h5>
                            <div class="accordion" id="accordion_pay">
                                <!-- PAYPAL -->
                                <article class="accordion-item">
                                    <h6 class="accordion-header">
                                        <label class="accordion-button collapsed"
                                            data-bs-toggle="collapse" data-bs-target="#collapseOne"
                                            aria-expanded="false">
                                            <input wire:model.defer="payment_mode" value="paypal" type="radio" name="payment_mode" class="accordions">
                                            &nbsp;
                                            Paypal
                                        </label>
                                    </h6>
                                    <div id="collapseOne" data-bs-parent="#accordion_pay"
                                        class="accordion-collapse collapse">
                                        <div class="accordion-body">
                                            <p class="text-center text-muted">
                                                "Connect your PayPal account and use it to pay your order. <br>You'll be redirected to PayPal to add your billing information."
                                                <br>
                                                <br>
                                            </p>
                                        </div>
                                    </div>
                                </article>
                                <!-- END_OF_PAYPAL -->
                                <!-- CREDIT_CARD -->
                                <article class="accordion-item">
                                    <h6 class="accordion-header">
                                        <label class="accordion-button collapsed"
                                            data-bs-toggle="collapse" data-bs-target="#collapseTwo"
                                            aria-expanded="false">
                                            <input wire:model.defer="payment_mode" value="paypal" type="radio" name="payment_mode" class="accordions">
                                            &nbsp;
                                            Credit Card
                                        </label>
                                    </h6>
                                    <div id="collapseTwo" data-bs-parent="#accordion_pay"
                                        class="accordion-collapse collapse">
                                        <div class="accordion-body">
                                            <p class="text-center text-muted">
                                                "You'll be redirected to PayPal to add your credit card and billing information<br>Your information is encrypted and processed by PayPal."
                                                <br>
                                                <br>
                                            </p>
                                        </div>
                                    </div>
                                </article>
                                <!-- END_OF_CREDIT_CARD -->
                                <!-- CASH_ON_DELIVERY -->
                                <article class="accordion-item">
                                    <h6 class="accordion-header">
                                        <label class="accordion-button collapsed"
                                            data-bs-toggle="collapse" data-bs-target="#collapseThree"
                                            aria-expanded="false">
                                            <input wire:model.defer="payment_mode" value="cod" type="radio" name="payment_mode" class="accordions">
                                            &nbsp;
                                            Cash on Delivery
                                        </label>
                                    </h6>
                                    <div id="collapseThree" data-bs-parent="#accordion_pay"
                                        class="accordion-collapse collapse">
                                        <div class="accordion-body">
                                            <p class="text-center text-muted">
                                                "Payment will be given upon delivery."
                                            </p>
                                        </div>
                                    </div>
                                </article>
                                <!-- END_OF_CASH_ON_DELIVERY -->
                            </div>
                        </div>
                    </article>
                @endif
            </div>

            
            
            <!-- SUMMARY_SECTION -->
            <aside class="col-lg-4">
                <article class="card">
                    <div class="card-body">
                        <h5 class="card-title checkout_card_title">Summary</h5>
                        <dl class="dlist-align">
                            <dt>Subtotal:</dt>
                            <dd class="text-end">₱ {{ number_format($this->totalCart, 2) }}</dd>
                        </dl>
                        {{--<dl class="dlist-align">
                            <dt>Discount:</dt>
                            <dd class="text-end text-danger">- ₱0.00</dd>
                        </dl>--}}
                        <dl class="dlist-align">
                            <dt>Shipping fee:</dt>
                            <dd class="text-end">+ ₱ 
                                @if($this->shipping) 
                                    {{ number_format($this->shipping, 2) }}
                                @else
                                    {{ number_format(0, 2) }}
                                @endif
                            </dd>
                        </dl>
                        <hr>
                        <dl class="dlist-align">
                            <dt>Total:</dt>
                            <dd class="text-end">
                                <strong class="text-dark">₱{{ number_format($this->grandTotal, 2) }}</strong>
                            </dd>
                        </dl>
                        <hr>
                        <h5 class="mb-4">Items in cart</h5>
                        @foreach ($cartItems as $cartItem)
                            <div class="itemside align-items-center mb-4">
                                <div class="aside">
                                    <b class="badge bg-secondary rounded-pill">{{ $cartItem->qty }}</b>
                                    <img class="img-sm rounded border checkout_img" src="{{ $this->getProductURL($cartItem->image) }}" alt="{{ $cartItem->name }}">
                                </div>
                                <div class="info">
                                    <a href="#" class="title">{{ $cartItem->name }}</a>
                                    <div class="price text-muted">Total: ₱{{ number_format($cartItem->selling_price * $cartItem->qty, 2) }}</div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </article>
            </aside>
        </div>
        <br>
        <br>
        <!-- PAYMENT METHOD -->
        <div class="row">
            <div class="col-lg-8">
                @if($this->showForm == true)
                <article class="card">
                    <div class="card-body">
                        <h5 class="card-title">Payment Method</h5>
                        <div class="accordion" id="accordion_pay">
                            <!-- PAYPAL -->
                            <article class="accordion-item">
                                <h6 class="accordion-header">
                                    <label class="accordion-button collapsed"
                                        data-bs-toggle="collapse" data-bs-target="#collapseOne"
                                        aria-expanded="false">
                                        <input wire:model.defer="payment_mode" value="paypal" type="radio" name="payment_mode" class="accordions">
                                        &nbsp;
                                        Paypal
                                    </label>
                                </h6>
                                <div id="collapseOne" data-bs-parent="#accordion_pay"
                                    class="accordion-collapse collapse">
                                    <div class="accordion-body">
                                        <p class="text-center text-muted">
                                            "Connect your PayPal account and use it to pay your order. <br>You'll be redirected to PayPal to add your billing information."
                                            <br>
                                            <br>
                                        </p>
                                    </div>
                                </div>
                            </article>
                            <!-- END_OF_PAYPAL -->
                            <!-- CREDIT_CARD -->
                            <article class="accordion-item">
                                <h6 class="accordion-header">
                                    <label class="accordion-button collapsed"
                                        data-bs-toggle="collapse" data-bs-target="#collapseTwo"
                                        aria-expanded="false">
                                        <input wire:model.defer="payment_mode" value="paypal" type="radio" name="payment_mode" class="accordions">
                                        &nbsp;
                                        Credit Card
                                    </label>
                                </h6>
                                <div id="collapseTwo" data-bs-parent="#accordion_pay"
                                    class="accordion-collapse collapse">
                                    <div class="accordion-body">
                                        <p class="text-center text-muted">
                                            "You'll be redirected to PayPal to add your credit card and billing information<br>Your information is encrypted and processed by PayPal."
                                            <br>
                                            <br>
                                        </p>
                                    </div>
                                </div>
                            </article>
                            <!-- END_OF_CREDIT_CARD -->
                            <!-- CASH_ON_DELIVERY -->
                            <article class="accordion-item">
                                <h6 class="accordion-header">
                                    <label class="accordion-button collapsed"
                                        data-bs-toggle="collapse" data-bs-target="#collapseThree"
                                        aria-expanded="false">
                                        <input wire:model.defer="payment_mode" value="cod" type="radio" name="payment_mode" class="accordions">
                                        &nbsp;
                                        Cash on Delivery
                                    </label>
                                </h6>
                                <div id="collapseThree" data-bs-parent="#accordion_pay"
                                    class="accordion-collapse collapse">
                                    <div class="accordion-body">
                                        <p class="text-center text-muted">
                                            "Payment will be given upon delivery."
                                        </p>
                                    </div>
                                </div>
                            </article>
                            <!-- END_OF_CASH_ON_DELIVERY -->
                        </div>
                    </div>
                </article>
                @endif
            </div>
            <aside class="col-lg-4">
                <article class="card">
                    <div class="card-body">
                            <button class="btn w-100 btn-success">Place Order</button>
                        </form>
                    </div>
                </article>
            </aside>
        </div>
        <!-- END OF PAYMENT METHOD -->
    </div>
</section>
    
    <!-- END OF CHECKOUT SUMMARY -->

@section('scripts')
   {{-- <script src="{{ asset('js/checkout.js') }}" type="text/javascript"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
@endsection