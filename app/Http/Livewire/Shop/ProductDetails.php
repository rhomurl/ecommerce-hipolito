<?php

namespace App\Http\Livewire\Shop;

use App\Models\{Product, Cart, Wishlist, OrderProduct};
use App\Traits\ModelComponentTrait;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;

use Livewire\Component;

class ProductDetails extends Component
{
    use LivewireAlert, ModelComponentTrait;

    protected $listeners = ['increaseQuantity' => 'addToCart'];
    
    public $cartProducts = [];
    public $slug, $productSold, $qty = 1;
    
    protected $messages = [
        'qty.integer' => 'Quantity must be an integer',
        'qty.min' => 'Quantity must be at least 1',
        'qty.max' => 'Quantity is maximum of 99'
    ];

    public function mount ($slug)
    {
        $this->slug = $slug; 
        $this->product = Product::where('slug', $this->slug)->firstorFail();
        $productsold = OrderProduct::where('product_id', $this->product->id)->sum('quantity');
        if($productsold){
            $this->productSold = $productsold;
        }

    }

    public function render()
    {
        $query = Product::query();

        $product = $this->product;

        $productId = (clone $query)->select('id')->where('slug', $this->slug);

        $related_products = Product::where('category_id', $product->category_id)
            ->whereNotIn('id', $productId)
            ->inRandomOrder()
            ->limit(4)
            ->get();
        
        $random_products = Product::whereNotIn('id', $productId)
            ->inRandomOrder()
            ->limit(3)
            ->get();
        
        return view('livewire.shop.product-details', compact('related_products', 'random_products'))->layout('layouts.user');
    }

    public function addToCart($productId, $qty)
    {
        $this->validate([
            'qty' => 'integer|min:1|max:99',
        ]);

        if(!Auth::check()){
            return redirect()->route('login');
        }

        $cart = Cart::where('product_id', $productId)
            ->where('user_id', Auth::id())
            ->first();

        if (!$cart) {
            Cart::create(['user_id' => Auth::id(), 'product_id' => $productId, 'qty' => $qty]);
        } 
        else {
            $cart->update(['qty' => $cart->qty + $qty]);
        }

        $this->cartProducts[] = $productId;
        $this->emit('updateWidgets');
        $this->successToast('Product Added to Cart!');
    }

    public function minusQty(){
        if($this->qty > 1){
            $this->qty = $this->qty - 1;
        }
    }
    public function addQty(){
        $this->qty = $this->qty + 1;
    }

    public function addToWishlist($id)
    {
        $this->validate([
            'qty' => 'integer|min:1|max:99',
        ]);

        if(!Auth::check()){
            return redirect()->route('login');
        }

        $wishlist = Wishlist::where('product_id', $id)
                    ->where('user_id', Auth::id())
                    ->first();
        
        if (!$wishlist) {
            Wishlist::create(['user_id' => Auth::id(), 'product_id' => $id]);
            $this->successToast('Product Added to Wishlist!');
            $this->emit('updateWidgets');
        } 
        else {
            $this->errorToast('Product Already in Wishlist!');
        }
    }
    
}
