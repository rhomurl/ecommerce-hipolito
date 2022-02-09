<?php

namespace App\Http\Livewire;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class UserHome extends Component
{
    public $cartProducts = [];
    
    public function mount(){
        $this->products = Product::limit(4)->get();
    }

    public function addToCart($productId)
    {
        if(!Auth::check()){
            return redirect()->route('login');
        }

        $cart = Cart::where('product_id', $productId)
                    ->where('user_id', Auth::id())
                    ->first();

        if (!$cart) {
            Cart::create(['user_id' => Auth::id(), 'product_id' => $productId, 'qty' => 1]);
        } 
        else {
            $cart->update(['qty' => $cart->qty + 1]);
        }
        $this->cartProducts[] = $productId;
        $this->emit('updateCart');

        session()->flash('message', 'Product Added to Cart');
        return redirect(route('cart'));
    }

    public function render()
    {
        return view('livewire.user-home')->extends('layouts.user');
    }
}
