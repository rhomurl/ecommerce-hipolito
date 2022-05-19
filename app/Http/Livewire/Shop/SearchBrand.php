<?php

namespace App\Http\Livewire\Shop;

use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Traits\ModelComponentTrait;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;
use Livewire\Component;

class SearchBrand extends Component
{
    use LivewireAlert;
    use WithPagination;
    use ModelComponentTrait;

    public $slug;
    public $perpage;

    public function mount($slug){
        $this->slug = $slug;
    }

    public function render()
    {
        $brand_id = Brand::select('id')->where('slug', '=', $this->slug)->firstOrFail();
        $this->brandname = Brand::select('name')->where('slug', '=', $this->slug)->firstOrFail();
        $results = Product::where('brand_id', $brand_id->id);
        
        $resultCount = $results->count();
        $results = $results->paginate($this->perpage);

        return view('livewire.shop.search-brand', compact('results', 'resultCount'))->layout('layouts.user');
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
            $this->add_to_cart_prompt();
        } 
        else {
            if($cart->qty >= $cart->product->quantity){
                $this->alert('error', 'Product Not Enough Stock!', [
                    'position' => 'top-end',
                    'timer' => '1500',
                    'toast' => true,
                    'timerProgressBar' => true,
                ]);
            }
            else {
            $cart->update(['qty' => $cart->qty + 1]);
            $this->add_to_cart_prompt();
            }
        }
        
        $this->emit('updateCart');
        
        
        //session()->flash('message', 'Product Added to Cart');
        //return redirect(route('cart'));
    }

    public function add_to_cart_prompt(){
        $this->alert('success', 'Product Added to Cart!', [
            'position' => 'top-end',
            'timer' => '1500',
            'toast' => true,
            'timerProgressBar' => true,
        ]);
    }
}
