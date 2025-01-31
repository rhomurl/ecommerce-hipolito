<?php

namespace App\Http\Livewire\Shop;

use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Traits\ModelComponentTrait;
use App\Models\Product;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;
use Livewire\Component;

class SearchResult extends Component
{
    use LivewireAlert;
    use WithPagination;
    use ModelComponentTrait;
    
    public $sdata;
    public $perpage;

    public function mount($sdata){
         $sdata = str_replace("+", " ", $sdata);
         //$this->sdata = str_replace("%2F", "/", $sdata);
    }

    public function render()
    {
        $results = Product::where('name', 'LIKE', '%' . $this->sdata . '%')
            ->orWhere('slug','LIKE', "%{$this->sdata}%");
        //$results->name = limitStr($results->name, 30);

        $resultCount = $results->count();
        $results = $results->paginate($this->perpage);
            //->paginate($this->perpage);

        //$resultCount = Product::where('name', 'LIKE', '%' . $this->sdata . '%')
         //   ->orWhere('slug','like','LIKE', "%{$this->sdata}%")
            //->count();

        return view('livewire.shop.search-result', compact('results', 'resultCount'))->layout('layouts.user');
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
            $this->successToast('Product Added to Cart!');
        } 
        else {
            if($cart->qty >= $cart->product->quantity){
                $this->errorToast('Product Not Enough Stock!');
            }
            else {
                $cart->update(['qty' => $cart->qty + 1]);
                $this->successToast('Product Added to Cart!');
            }
        }
        
        $this->emit('updateWidgets');
    }
}
