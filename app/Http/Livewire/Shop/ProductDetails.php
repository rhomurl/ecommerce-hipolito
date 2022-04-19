<?php

namespace App\Http\Livewire\Shop;

//use Google\Cloud\Storage\StorageClient;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Wishlist;
use App\Traits\ModelComponentTrait;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ProductDetails extends Component
{
    use LivewireAlert;
    use ModelComponentTrait;

    protected $listeners = ['increaseQuantity' => 'addToCart'];
    
    public $cartProducts = [];
    public $slug, $qty = 1;
    

    public function mount ($slug)
    {
        $this->slug = $slug; 
       
        $this->product = Product::where('slug', $this->slug)->firstorFail();
    }

    public function render()
    {
        

        $query = Product::query();
        $product = (clone $query)
            ->where('slug', $this->slug)
            ->first();
        $productId = (clone $query)
            ->select('id')
            ->where('slug', $this->slug);
        $related_products = Product::where('category_id', $product->category_id)
            ->whereNotIn('id', $productId)
            ->inRandomOrder()
            ->limit(8)
            ->get();
        
        //$product_image_url = $disk->temporaryUrl($product_url, now()->addMinutes(30));

        return view('livewire.shop.product-details', compact('related_products'))->layout('layouts.user');
    }

    
    public function addToCart($productId, $qty)
    {
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
        $this->emit('updateCart');

        /*$this->alert('success', 'Product Added to Cart!', [
            'position' => 'top-end',
            'timer' => '1500',
            'toast' => true,
            'timerProgressBar' => true,
        ]);*/
        $this->successToast('Product Added to Cart!');
        //session()->flash('message', 'Product Added to Cart');
        //return redirect(route('cart'));
        
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
        if(!Auth::check()){
            return redirect()->route('login');
        }

        $wishlist = Wishlist::where('product_id', $id)
                    ->where('user_id', Auth::id())
                    ->first();
        
        if (!$wishlist) {
            Wishlist::create(['user_id' => Auth::id(), 'product_id' => $id]);
            $this->successToast('Product Added to Wishlist!');
        } 
        else {
            $this->errorToast('Product Already in Wishlist!');
        }
    }
    
}
