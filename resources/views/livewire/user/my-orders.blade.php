@section('title', 'My Orders')
    
<div>
    @if($orders)
        {{ $orders->links() }}
    @endif

    @forelse($orders as $order)
        <article class="card mb-4">
        <header class="card-header">
            {{--<a href="#" class="float-right"> <i class="fa fa-print"></i> Print</a>--}}

            <strong class="d-inline-block mr-3">Order ID: {{ $order->id }}</strong>
            <span class="float-right">Order Date: {{ \Carbon\Carbon::parse($order->created_at)->isoFormat('MMM Do YYYY') }}</span>

        </header>
        <div class="card-body">
            <div class="row"> 
                <div class="col-md-8">
                    Status: 
                    
                    @if($order->status == "pending")
                        Pending
                    @elseif($order->status == "ordered")
                        Ordered
                    @elseif($order->status == "processing")
                        Processing
                    @elseif($order->status == "delivered")
                        Delivered
                    @endif
                    <br><br>
                    <a href="{{ route('user.order.details', $order->id ) }}" class="btn btn-outline-primary mb-2">More Details</a> 
                    <br>
                    @if($order->status == "pending")
                        <a wire:click.prevent="paynow({{ $order->id }})" href="#" class="btn btn-outline-primary">Pay Now</a>
                    @endif
                </div>

                <div class="col-md-4">
                    <h6 class="text-muted">Payment</h6>
                    <span class="text-success">
                        
                        @if($order->transaction->mode == 'paypal')
                            PayPal
                        @elseif($order->transaction->mode == 'cod')
                            Cash on Delivery
                        @else
                            Cash on Delivery    
                        @endif
                        
                        
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

        </article> <!-- card order-item .// -->
    @empty
        No orders found
    @endforelse

    
</div>
