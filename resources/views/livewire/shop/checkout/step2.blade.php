<div class="container" style="max-width:720px;">
      {{ $this->transid }}
    <main class="col-md-12 mt-5">
      <div class="card">
        <h4 class="card-title m-3">Online Payment</h4>
        <div id="paypal-button-container"></div>
      </div>
      <span class="text-danger">
        Please do not back or refresh the page to prevent unsuccessful transaction
      </span>
    
    {{--<div class="card mb-4">
      <div class="card-body">
      <h4 class="card-title mb-4">Order Total</h4>
        
        
        <span class="text-xl">Subtotal:</span><span class="text-xl"> ₱ {{ $this->totalCart }}</span><br>
      
        <span class="text-xl">Delivery fee:</span> <span class="text-xl"> ₱ {{ $this->shipping }}<br>
        @if($this->discount)
          <span class="font-bold text-xl">Discount:</span> <span class="text-xl">₱ {{ $this->discount }} </span><br>
          <span class="font-bold text-xl">Grand Total:</span> <span class="text-xl">₱ {{ $this->grandTotal - $this->discount }} </span>
        @else
        <span class="font-bold text-xl">Grand Total:</span> <span class="text-xl">₱ {{ $this->grandTotal }} </span>
        @endif
        <br><br>
        
      </div> 
    </div>--}}
  </main>
    </div>

   
   
    
    {{--<div class="card mt-4 mb-4">
      <div class="card-body">
      <h4 class="card-title mb-4">Voucher</h4>
      <form wire:submit.prevent="applyCoupon" style="max-width:380px;">
          <div class="input-group w-50">
            <input wire:model="voucher" type="text" class="form-control">
          </div>
          @if($this->voucher_msg)
            <p class="text-danger">{{ $this->voucher_msg }}</p>
          @endif
          <br>
          <button type="submit" class="btn btn-primary float-md-left">Apply Voucher</button>
      </form>
      
      </div>  
    </div>--}}
  </div>
  

      <br><br> 
      
@section('scripts')
  <script src="https://www.paypal.com/sdk/js?client-id=AckmZ9rFsnnMBcJmQ22Ruw5OaYT3n2Rm6ZXd06UqX-XXZbTBSLphD9hLvzZ0xb7rtMT5g-U_5N2fvyMa&currency=PHP&locale=en_PH&disable-card=amex,jcb,discover"></script>
  @include('livewire.shop.checkout-js')
@endsection