<?php

namespace App\Http\Livewire\Shop;

use Session;
use App\Traits\ModelComponentTrait;
use App\Models\Cart;
use App\Models\Product;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Support\Facades\Auth;
use App\Services\WishlistService;
use Livewire\Component;

class ShoppingCart extends Component
{
    use LivewireAlert;
    use ModelComponentTrait;

    protected $listeners = ['increaseQuantity' => 'addToCart'];

    //public $shipping;
    public $subTotal;
    //public $totalCartWithoutTax;
    //public $countries;
    public $checkout_message;

    public function mount(){
        $this->checkout_message = Session::get('checkout_message');
    }

    public function render()
    {
        $cartItems = Cart::with('products')->get()->where('user_id', Auth::id())
            ->map(function (Cart $items) {
                return (object)[
                    'id' => $items->product_id,
                    //'user_id'=> $items->user_id,
                    'slug' => $items->products->slug,
                    'name' => $items->products->name,
                    'brand' => $items->products->brand->name,
                    'image' => $items->products->image,
                    'quantity' => $items->products->quantity,
                    'selling_price' => $items->products->selling_price,
                    'qty' => $items->qty,
                    'total' => ($items->qty * $items->products->selling_price),
                ];
            } );

            $this->subTotal = $cartItems->sum('total');

            
            //$this->totalCartWithoutTax = $this->subTotal + $this->shipping;

        return view('livewire.shop.shopping-cart', compact('cartItems'));
    }

    public function setAmountForCheckout(){ 
        /*
        if($this->subTotal < 100){
            return redirect()->route('cart')->with('checkout_message', 'Subtotal must be 100 PHP above.');
        }*/
        $cart = Cart::with('product')->where('user_id', Auth::id())->get();
        $products = Product::select('id', 'quantity')
            ->whereIn('id', $cart->pluck('product_id'))
            ->pluck('quantity', 'id');

        foreach ($cart as $cartProduct){
            if(!isset($products[$cartProduct->product_id]) 
                || $products[$cartProduct->product_id] <= $cartProduct->qty) {
                    Cart::where('product_id', $cartProduct->product->id)
                    ->where('user_id', Auth::id())->delete();


                return redirect()
                ->route('cart')
                ->with('checkout_message', $cartProduct->product->name . " is out of stock.");
            }
            
        }
         redirect()->route('checkout.step1');
    }
    
    public function increaseQuantity($id)
    {
        $this->emit('increaseQuantity', $id);
    }

    public function decreaseQuantity($id, $qty)
    {
        if ($qty != 1) {
            Cart::where('product_id', $id)
                ->where('user_id', Auth::id())
                ->update(['qty' => $qty - 1]);
        } else {
            Cart::where('product_id', $id)
                ->where('user_id', Auth::id())
                ->delete();
            $this->emit('updateWidgets');
        }
        
    }

    public function removefromCart($id)
    {
        Cart::where('product_id', $id)
            ->where('user_id', Auth::id())
            ->delete();
            $this->emit('updateWidgets');
    }

    public function addToCart($id, WishlistService $cart)
    {
        if(!Auth::check()){
            return redirect()->route('login');
        }
        $cart->addCart($id);
    }
}
