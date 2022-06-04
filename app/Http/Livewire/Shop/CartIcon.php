<?php

namespace App\Http\Livewire\Shop;

use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use Livewire\Component;

class CartIcon extends Component
{
    protected $listeners = ['updateWidgets' => 'render'];

    public function render()
    {
        if(Auth::user()){
            $cart_count = Cart::where('user_id', Auth::user()->id)->count();
        }
        else{
            $cart_count = 0;
        }
        return view('livewire.shop.cart-icon', compact('cart_count'));
    }
}
