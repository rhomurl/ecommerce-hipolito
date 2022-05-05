@section('title', 'My Orders')
    
<div>


{{--    <nav class="m-4" aria-label="Page navigation example">
  <ul class="pagination justify-content-end">
    <li class="page-item disabled">
      <a class="page-link" href="#" tabindex="-1">Previous</a>
    </li>
    <li class="page-item"><a class="page-link" href="#">1</a></li>
    <li class="page-item"><a class="page-link" href="#">2</a></li>
    <li class="page-item"><a class="page-link" href="#">3</a></li>
    <li class="page-item">
      <a class="page-link" href="#">Next</a>
    </li>
  </ul>
</nav>
--}}

    @if($orders)
        {{ $orders->links('livewire.pagination.defaultuser')}}
    @endif

    @forelse($orders as $order)
        <article class="card mb-4">
        <header class="card-header">
            {{--<a href="#" class="float-right"> <i class="fa fa-print"></i> Print</a>--}}

            <strong class="d-inline-block mr-3">Order ID: {{ $order->id }}</strong>
            <span class="float-right">Order Date: {{ \Carbon\Carbon::parse($order->created_at)->isoFormat('Do MMM YYYY, h:mm a') }}</span>

        </header>
        <div class="card-body">
            <div class="row"> 
                <div class="col-md-8">
                    Status: 
                    
                    @if($order->status == "pending")
                        Pending
                    @elseif($order->status == "cancelled")
                        Cancelled
                    @elseif($order->status == "ordered")
                        Ordered
                    @elseif($order->status == "processing")
                        Processing
                    @elseif($order->status == "otw")
                        On The Way
                    @elseif($order->status == "delivered")
                        Delivered
                    @endif
                    <br><br>
                     
                    <br>
                    @if($order->status == "pending" || ($order->transaction->mode == "cod" && $order->status == "ordered"))

                    <div x-data="{ confirmDelete:false }" class="overflow-hidden">
                        <button x-show="!confirmDelete" x-on:click="confirmDelete=true" class="btn btn-outline-primary">
                            Cancel
                        </button>
                        <div class="overflow-hidden">
                            <span x-show="confirmDelete">Are you sure you want to cancel?<br></span>
                            <a wire:click.prevent="cancelOrder({{ $order->id }})" x-show="confirmDelete" x-on:click="confirmDelete=false" href="#" class="btn btn-outline-danger">Yes</a>
                            <a x-show="confirmDelete" x-on:click="confirmDelete=false" class="btn btn-outline-danger">No</a>
                        </div>
                    </div>
                    @endif

                    @if($order->status == "pending")
                        <a wire:click.prevent="paynow({{ $order->id }})" href="#" class="btn btn-outline-danger">Pay Now</a>
                    @endif
                    
                    @if($order->status == "pending" && $order->transaction->mode == "paypal")
                    <br><br>
                        Please pay before <b>{{ \Carbon\Carbon::parse($order->created_at)->addMinutes(60)->isoFormat('MMM D, YYYY, h:mm a') }}</b> to avoid cancellation.
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
                    <a href="{{ route('user.order.details', $order->uuid ) }}" class="btn btn-outline-primary mb-2">More Details</a>
                    
                </div>
            </div> <!-- row.// -->
        </div> <!-- card-body .// -->

        </article> <!-- card order-item .// -->
    @empty
        <div class="card-body">

            <div class="row">
        No orders found
            </div>
        </div>
    @endforelse

    
</div>
