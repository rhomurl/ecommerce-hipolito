<?php

namespace App\Http\Livewire;

use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Traits\ModelComponentTrait;
//use App\Models\Cart;
use App\Models\{Banner, Product};
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class UserHome extends Component
{
    use LivewireAlert;
    use ModelComponentTrait;

    public function mount(){
        $product_query = Product::query();

        /*
         ? This is for home page logic
         ! Always check for n+1 query!!
         TODO: Make the product featured priority for low purchase of orders
        */
        $this->products = $product_query
            ->with('brand')
            ->whereNotNull('quantity')
            ->take(12)
            ->get();

        $this->l_products = $product_query
            ->whereNotNull('quantity')
            ->take(6)
            ->orderBy('id', 'DESC')
            ->get();
            
        $this->banners = Banner::take(5)->get();
    }

    public function render()
    {
        return view('livewire.user-home')->extends('layouts.user');
    }

    /*
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

        $this->alert('success', 'Product Added to Cart!', [
            'position' => 'top-end',
            'timer' => '1500',
            'toast' => true,
            'timerProgressBar' => true,
        ]);
        //session()->flash('message', 'Product Added to Cart');
        //return redirect(route('cart'));
    }
    */

}
