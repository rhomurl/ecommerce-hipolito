<?php

namespace App\Http\Livewire\Shop\Checkout;

use DB;
use Session;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\AddressBook;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Step1 extends Component
{
    public $voucher, $discount, $voucher_msg, $vouchercount, $usage_qty;
    public $address_book_id, $payment_mode, $checkout_message, $shipping, $transid;

    public function render()
    {
        $addresses = AddressBook::with('barangay.city')
        ->where('user_id', Auth::id())
        ->latest()
        ->take(5)
        ->get();

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

        if($cartItems->count() == 0){
            redirect(route('cart'));
        }
 
         $this->totalCart = $cartItems->sum('total');
         $this->totalCartWithoutTax = $cartItems->sum('total') + $this->shipping;
         $this->grandTotal = $this->totalCartWithoutTax;

        return view('livewire.shop.checkout.step1', compact('addresses', 'cartItems'))->layout('layouts.user');
    }

    public function placeOrder()
    {
        $this->validate([
            'address_book_id' => 'required',
            //'payment_mode' => 'required',
        ]);
                
        $cart = Cart::with('product')->where('user_id', Auth::id())->get();
        $products = Product::select('id', 'quantity')
            ->whereIn('id', $cart->pluck('product_id'))
            ->pluck('quantity', 'id');

        foreach ($cart as $cartProduct){
            if(!isset($products[$cartProduct->product_id]) 
                || $products[$cartProduct->product_id] < $cartProduct->qty) {
                $this->checkout_message = 'Error: Product ' . $cartProduct->product->name . ' not found in stock';
            }
        }

        try{
            $this->resetValidation();
            DB::transaction(function () use ($cart) {
                /*
                $order = Order::create([
                    'user_id' => auth()->id(),
                    'address_book_id' => $this->address_book_id/1,
                    'subtotal' => $this->totalCart,
                    'discount' => $this->discount,
                    'shippingfee' => $this->shipping,
                    'total' => $this->grandTotal - $this->discount,
                    'status' => 'pending'
                ]);*/

                $order = new Order();
                $order->user_id = auth()->id();
                $order->address_book_id = $this->address_book_id/1;
                $order->subtotal = $this->totalCart;
                $order->discount = $this->discount;
                $order->shippingfee = $this->shipping;
                $order->total = $this->grandTotal - $this->discount;
                if($this->payment_mode == 'cod'){
                    $order->status = 'ordered';
                }
                else{
                    $order->status = 'pending';
                }
                $order->save();

                foreach ($cart as $cartProduct){
                    $order->products()->attach($cartProduct->product_id, [
                        'quantity' => $cartProduct->qty,
                        'user_id' => auth()->id(),
                        'price' => $cartProduct->product->selling_price,
                    ]);
                    Product::find($cartProduct->product_id)->decrement('quantity', $cartProduct->qty);
                }

                $transaction = new Transaction();
                $transaction->order_id = $order->id;
                $transaction->user_id = Auth::user()->id;
                $transaction->mode = $this->payment_mode;
                if($this->payment_mode == 'cod'){
                    $transaction->status = 'ordered';
                }
                else{
                    $transaction->status = 'pending';
                }
                $transaction->save();
               
                Cart::where('user_id', Auth::user()->id)->delete();        
                $this->emit('updateCart');

                //Session::flash('orderid', $order->id);
               // dd($order->id);
               if($this->payment_mode == 'cod'){
                    redirect()
                    ->route('checkout.success')
                    ->with('orderid', $order->id);
               }
                else{
                    redirect()
                    ->route('checkout')
                    ->with('orderid', $order->id);
                }
               
            });
        } catch (\Exception $exception){
            //$this->checkout_message = "Something wrong";
            dd($exception->getMessage());
        }
    }
}
