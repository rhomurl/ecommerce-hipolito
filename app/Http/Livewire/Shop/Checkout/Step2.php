<?php

namespace App\Http\Livewire\Shop\Checkout;

//use App\Models\Cart;
//use App\Models\Voucher;
//use App\Models\Product;
//use Illuminate\Notifications\Notifiable;
//use App\Models\AddressBook;
use DB;
use Session;
use Carbon\Carbon;
use App\Models\{Transaction, Order};
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Step2 extends Component
{
    public $voucher, $discount, $voucher_msg, $vouchercount, $usage_qty;
    public $address_book_id, $payment_mode, $checkout_message, $shipping, $transid;
    
    public function mount(){

        $orderid = Session::get('orderid');
        $this->orderidz = Session::get('orderid');
        $order = Order::where('id', $orderid)->firstorFail();
        $this->uuid = $order->uuid;

        $transaction = Transaction::where('order_id', $orderid)
            ->where('status', 'cancelled')->first();
        if($transaction){
            abort(404);
        }
        
        if(!$order)
        {
           return redirect()->route('cart');
        }
        $this->grandTotal = $order->total;
    }

    public function render()
    {
        if(!Session::has('orderid'))
        {
            redirect()->route('cart');
        }
        return view('livewire.shop.checkout.step2')->layout('layouts.user');
    }
    
    public function response()
    {
        //Cart::where('user_id', Auth::user()->id)->delete();        
        //session()->forget('checkout');
        //$this->emit('updateCart');

    }
        
}


/*public function applyCoupon(){

        
        $voucher = Voucher::where('code', $this->voucher)->first();
        

        if(!$this->address_book_id){
            $this->voucher_msg = 'Select an address first!';
        }
        else if($voucher)
        {
            if($this->grandTotal < $voucher->min_spend){
                $this->voucher_msg = 'You are not qualified from this promo.';
            }
            else if($voucher->usage_qty == 0){
                $this->voucher_msg = 'Voucher is invalid or expired';
            }
            else{
                $this->voucherqty = $voucher->usage_qty/1; 
                if($voucher->discount_type == 'percent'){
                    $dsc = $voucher->discount_amt/100;
                    $this->discount = $dsc * $this->grandTotal;
                }
                else{
                    $this->discount = $voucher->discount_amt/1;
                }
                $this->grandTotal = $this->grandTotal - $this->discount;
                $this->voucher_msg = 'Voucher code applied!';
            }
        }
        else {
            $this->voucher_msg = 'Voucher is invalid or expired';
        }
    }*/