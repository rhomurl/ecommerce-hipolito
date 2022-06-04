<?php

namespace App\Http\Livewire\Shop;

use Illuminate\Support\Facades\Auth;
use App\Models\Wishlist;
use Livewire\Component;

class WishlistIcon extends Component
{
    protected $listeners = ['updateWidgets' => 'render'];
    
    public function render()
    {
        if(Auth::user()){
            $wishlist_count = Wishlist::where('user_id', Auth::user()->id)->count();
        }
        else{
            $wishlist_count = 0;
        }
        return view('livewire.shop.wishlist-icon', compact('wishlist_count'));
    }
}
