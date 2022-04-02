<?php

namespace App\Http\Livewire\User;

use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Traits\ModelComponentTrait;

use Illuminate\Support\Facades\Auth;

use App\Models\Wishlist;
use App\Models\Cart;

use Livewire\Component;

class MyWishlists extends Component
{
    use LivewireAlert;
    use ModelComponentTrait;

    public function render()
    {
        $wishlists = Wishlist::where('user_id', Auth::id())->get();
        //dd($wishlists);

        return view('livewire.user.my-wishlists', compact('wishlists'))->extends('layouts.user-profile');
    }

    public function addToCart($id)
    {
        if(!Auth::check()){
            return redirect()->route('login');
        }

        $cart = Cart::where('product_id', $id)
                    ->where('user_id', Auth::id())
                    ->first();

        if (!$cart) {
            Cart::create(['user_id' => Auth::id(), 'product_id' => $id, 'qty' => 1]);
        } 
        else {
            $cart->update(['qty' => $cart->qty + 1]);
        }
        //$this->cartProducts[] = $id;
        $this->emit('updateCart');
        $this->successToast('Product Added to Cart!');

        
    }

    public function removefromWishlist($id)
    {
        $wishlist = Wishlist::where('id', $id)
                    ->where('user_id', Auth::id());
        $wishlist2 =  $wishlist->first();

        if ($wishlist) {
            $wishlist->delete();
            $this->successToast('Product Removed From Wishlist!');
        } 

       
    }
}
