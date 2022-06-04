<?php

namespace App\Http\Livewire\User;

use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Traits\ModelComponentTrait;

use Illuminate\Support\Facades\Auth;

use App\Models\Wishlist;
use App\Models\Cart;
use App\Services\WishlistService;

use Livewire\Component;

class MyWishlists extends Component
{
    use LivewireAlert;
    use ModelComponentTrait;

    public function render()
    {
        $wishlists = Wishlist::where('user_id', Auth::id())->get();
        return view('livewire.user.my-wishlists', compact('wishlists'))->extends('layouts.user-profile');
    }

    public function addToCart($id, WishlistService $cart)
    {
        if(!Auth::check()){
            return redirect()->route('login');
        }
        $cart->addCart($id);

        $this->successToast('Product Added to Cart!');
        $this->emit('updateWidgets');
    }

    public function removefromWishlist($id)
    {
        $wishlist = Wishlist::where('id', $id)->where('user_id', Auth::id());
        $wishlist->delete();
        $this->successToast('Product Removed From Wishlist!');
        $this->emit('updateWidgets');
    }
}
