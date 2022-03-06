<?php

namespace App\Http\Livewire\Shop;


use DB;
use Session;
use Carbon\Carbon;

use App\Models\Cart;
//use App\Models\Voucher;
use App\Models\Order;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\AddressBook;

use Illuminate\Support\Facades\Auth;
//use Illuminate\Notifications\Notifiable;
use Livewire\Component;

class Checkout extends Component
{
    public $voucher, $discount, $voucher_msg, $vouchercount, $usage_qty;
    public $address_book_id, $payment_mode, $checkout_message, $shipping, $transid;
    
    public function mount(){

        $orderid = Session::get('orderid');
        $this->orderidz = Session::get('orderid');
        $order = Order::where('id', $orderid)->firstorFail();
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

        
        
        /*$addresses = AddressBook::with('barangay.city')
        ->where('user_id', Auth::id())
        ->latest()
        ->take(5)
        ->get();

        $old_cartItems = Cart::with('products')->get()->where('user_id', Auth::id())
            ->map(function (Cart $items) {
                return (object)[
                    'id' => $items->product_id,
                    'user_id'=> $items->user_id,
                    'slug' => $items->products->slug,
                    'name' => $items->products->name,
                    'brand' => $items->products->brand->name,
                    'image' => $items->products->image,
                    'selling_price' => $items->products->selling_price,
                    'qty' => $items->qty,
                    'total' => ($items->qty * $items->products->selling_price),
                ];
            }
        );

        foreach($old_cartItems as $item)
        {
            if(!Product::where('id', $item->id)->where('quantity', '>=', $item->qty)->exists())
            {
                $removeItem = Cart::where('user_id', Auth::id())->where('product_id', $item->id)->first();
                $removeItem->delete();
            }
        }

        $cartItems = Cart::with('products')->get()->where('user_id', Auth::id())
            ->map(function (Cart $items) {
                return (object)[
                    'id' => $items->product_id,
                    'user_id'=> $items->user_id,
                    'slug' => $items->products->slug,
                    'name' => $items->products->name,
                    'brand' => $items->products->brand->name,
                    'image' => $items->products->image,
                    'selling_price' => $items->products->selling_price,
                    'qty' => $items->qty,
                    'total' => ($items->qty * $items->products->selling_price),
                ];
            } 
        );

        

        $this->totalCart = $cartItems->sum('total');

        if($this->totalCart > 2500){
            $this->shipping = 0;
        }
        else{
            if($this->address_book_id){
                $addr = AddressBook::where('id', $this->address_book_id)->first();
                $this->shipping = $addr->barangay->shippingfee;
            }
        }

        $this->totalCartWithoutTax = $cartItems->sum('total') + $this->shipping;
        $this->grandTotal = $this->totalCartWithoutTax;
        */
        return view('livewire.shop.checkout')->layout('layouts.user');
    }
    
    public function response()
    {
        Cart::where('user_id', Auth::user()->id)->delete();        
        //session()->forget('checkout');
        $this->emit('updateCart');
        //Session::flash('orderid', '69');
        //redirect()->route('checkout.success');

        //$msg = "This is a simple message.";
        //return response()->json(array('msg'=> $msg), 200);
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