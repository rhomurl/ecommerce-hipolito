<?php

namespace App\Http\Livewire\Shop;

use App\Models\Cart;
use App\Models\Product;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ShoppingCart extends Component
{
    use LivewireAlert;

    protected $listeners = ['updateCart' => 'render', 'increaseQuantity' => 'addToCart'];

    public $shipping;
    public $totalCart;
    public $totalCartWithoutTax;
    public $countries;
    public $checkout_message;


    public function render()
    {
        $cartItems = Cart::with('products')->get()->where('user_id', Auth::id())
            ->map(function (Cart $items) {
                return (object)[
                    'id' => $items->product_id,
                    'user_id'=> $items->user_id,
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

            $this->totalCart = $cartItems->sum('total');
            $this->totalCartWithoutTax = $cartItems->sum('total') + $this->shipping;

        return view('livewire.shop.shopping-cart', compact('cartItems'));
    }

    public function setAmountForCheckout(){ 
        
        $cart = Cart::with('product')->where('user_id', Auth::id())->get();
        $products = Product::select('id', 'quantity')
            ->whereIn('id', $cart->pluck('product_id'))
            ->pluck('quantity', 'id');

        foreach ($cart as $cartProduct){
            if(!isset($products[$cartProduct->product_id]) 
                || $products[$cartProduct->product_id] < $cartProduct->qty) {
                $this->checkout_message = 'Error: Product ' . $cartProduct->product->name . ' not found in stock';
            }
            return redirect()->route('checkout.step1');
        }
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
        }
        $this->emit('updateCart');
    }

    public function removefromCart($id)
    {
        Cart::where('product_id', $id)
            ->where('user_id', Auth::id())
            ->delete();
        $this->emit('updateCart');
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
            Cart::create(['user_id' => Auth::id(), 
                        'product_id' => $productId, 
                        'qty' => 1
            ]);
        } 
        else {
            $cart->update(['qty' => $cart->qty + 1]);
        }
        
        $this->emit('updateCart');
    }
}
