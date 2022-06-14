<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\Wishlist;

class WishlistService {

    public function addCart($id): Cart
    {
        $cart = Cart::where('product_id', $id)
                    ->where('user_id', Auth::id())
                    ->first();

        if (!$cart) {
            $cart = Cart::create(['user_id' => Auth::id(), 'product_id' => $id, 'qty' => 1]);
        } 
        else {
            $cart->update(['qty' => $cart->qty + 1]);
        }

        return $cart;
    }


}