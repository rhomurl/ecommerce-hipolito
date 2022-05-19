<?php

namespace App\Http\Livewire\Components;

use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\Wishlist;

use Livewire\Component;

class HeaderWidgets extends Component
{
    protected $listeners = ['updateWidget' => 'render'];
    public $wishlist_count, $cart_count;

    public function render()
    {
        if(Auth::user()){
            $this->cart_count = Cart::where('user_id', Auth::user()->id)->get();
            $this->wishlist_count = Wishlist::where('user_id', Auth::user()->id)->get();
        }
        else{
            $this->cart_count = 0;
            $this->wishlist_count = 0;

        }
        return view('livewire.components.header-widgets');
    }
}
