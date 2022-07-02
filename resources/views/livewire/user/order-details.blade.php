@section('title', 'Order Details')
<div>
    

    
    <article class="card mb-4">
        
        <header class="card-header">
            <a href="{{ route('user.orders') }}" class="btn btn-primary"> <i class="fa fa-chevron-left"></i> Back to My Orders</a><br><br>
            <strong class="d-inline-block mr-3">Order ID: {{ $order->id }}</strong>
            <span class="float-right">Order Date and Time: {{ \Carbon\Carbon::parse($order->created_at)->format('F j Y h:i A')}}</span>
        </header>
        <div class="card-body">
            <div class="tracking-wrap">
                @if($order->status == 'cancelled')
                    <div class="step {{ $order->status == 'cancelled' ? 'error' : 'error' }}">
                        <span class="icon"> <i class="fa fa-times"></i> </span>
                        <span class="text">Cancelled</span>
                    </div> <!-- step.// -->
                @else
                    <div class="step {{ $order->status == 'ordered' ? 'active' : 'active' }}">
                        <span class="icon"> <i class="fa fa-check"></i> </span>
                        <span class="text">Order Placed</span>
                    </div> <!-- step.// -->
                @endif
                
                    @if($order->status == 'ordered')
                        <div class="step">
                    @elseif($order->status == 'processing')
                        <div class="step active">
                    @elseif($order->status == 'otw')
                        <div class="step active">
                    @elseif($order->status == 'delivered')
                        <div class="step active">
                    @else
                        <div class="step">
                    @endif
                
                    <span class="icon"> <i class="fa fa-user"></i> </span>
                    <span class="text">Processing</span>
                </div> <!-- step.// -->

                    @if($order->status == 'ordered')
                        <div class="step">
                    @elseif($order->status == 'processing')
                        <div class="step">
                    @elseif($order->status == 'otw')
                        <div class="step active">
                    @elseif($order->status == 'delivered')
                        <div class="step active">
                    @else
                        <div class="step">
                    @endif

                    <span class="icon"> <i class="fa fa-truck"></i> </span>
                    <span class="text">On the way</span>
                </div> <!-- step.// -->

                    @if($order->status == 'ordered')
                        <div class="step">
                    @elseif($order->status == 'processing')
                        <div class="step">
                    @elseif($order->status == 'otw')
                        <div class="step">
                    @elseif($order->status == 'delivered')
                        <div class="step active">
                    @else
                        <div class="step">
                    @endif

                    <span class="icon"> <i class="fa fa-box"></i> </span>
                    <span class="text">Delivered</span>
                </div> <!-- step.// -->
            </div><br>

            <div class="row"> 
                <div class="col-md-8">
                    <h6 class="text-muted">Delivery to</h6>
                    <p>{{ $address->entry_firstname }} {{ $address->entry_lastname }} <br>  
                        @if($address->entry_company)
                            {{ $address->entry_company }}<br>
                        @endif
                        <b>Landmark:</b> {{ $address->entry_landmark }}<br>
                        {{ $address->entry_street_address }}<br> {{ $address->barangay->name }}, {{ $address->barangay->city->name }}, {{ $address->barangay->city->zip }}<br>{{ $address->entry_phonenumber }}  
                    </p>
                </div>

                
                <div class="col-md-4">
                    <h6 class="text-muted">Payment</h6>
                    <span class="text-success">
                        {{ $order->getPaymentModeAttribute() }}
                    </span>
                    <p>Subtotal: ₱ {{ $order->subtotal }} <br>
                        Shipping fee: ₱ 
                        @if(!$order->shippingfee)
                        0.00
                        @else
                            {{ $order->shippingfee }}
                        @endif <br> 
                        @if($order->discount)
                            <span class="b">Discount: ₱  {{ $order->discount }} </span><br>
                        @endif
                        <span class="b">Total: ₱ {{ $order->total }} </span>
                    </p>
                </div>
            </div> <!-- row.// -->
        </div> <!-- card-body .// -->
        
        <div class="table-responsive">
        <table class="table table-hover ml-5">
                <tbody>
        <p class="p-2">Products</p>
            @foreach ($order->orderProduct as $key => $item)
            <ul class="row">
                <li class="col-md-5">
                    <figure class="itemside mb-3">
                        <div class="aside"><img src="{{ $this->getProductURL($item->product->image) }}" class="img-sm border"></div>
                        <figcaption class="info align-self-center">
                            <p class="title">{{ $item->product->name}}</p>
                            <span class="text-muted">₱ {{$item->price}} <br> Qty: {{$item->quantity}}</span>
                        </figcaption>
                    </figure> 
                </li>
            </ul>   
            @endforeach
        </tbody></table>
        </div> <!-- table-responsive .end// -->
    </article>
</div>