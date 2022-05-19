<?php

namespace App\Http\Livewire;

use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Traits\ModelComponentTrait;
//use App\Models\Cart;
use App\Models\Banner;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class UserHome extends Component
{
    use LivewireAlert;
    use ModelComponentTrait;

    public $cartProducts = [];
    
    public function mount(){
        $this->products = Product::whereNotNull('quantity')->take(12)->get();
        $this->l_products = Product::whereNotNull('quantity')->take(6)->orderBy('id', 'DESC')->get();
        $this->banners = Banner::take(5)->get();
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

    public function render()
    {
        return view('livewire.user-home')->extends('layouts.user');
    }
}
