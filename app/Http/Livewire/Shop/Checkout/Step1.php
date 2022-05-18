<?php

namespace App\Http\Livewire\Shop\Checkout;

use DB;
use App\Traits\ModelComponentTrait;
use Jantinnerezo\LivewireAlert\LivewireAlert;

use App\Notifications\OrderNotification;

use App\Models\AddressBook;
use App\Models\Barangay;
use App\Models\Cart;
use App\Models\City;
use App\Models\Order;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;

use Illuminate\Support\Facades\Auth;

use Livewire\Component;

class Step1 extends Component
{
    protected $listeners = ['updateAddress' => 'render'];
    use LivewireAlert;
    use ModelComponentTrait;
    public $showForm = false;
    public $barangays, $barangay;
    public $cities, $city;
    public $error_message, 
    $entry_company, 
    $entry_landmark, 
    $entry_firstname, 
    $entry_lastname, 
    $entry_street_address, 
    $entry_phonenumber, 
    $entry_postcode,
    $shipping_type,
    $setAddr;

    public $voucher, $discount, $voucher_msg, $vouchercount, $usage_qty;
    public $address_book_id, $payment_mode, $checkout_message, $shipping, $transid;

    public function mount(){
        if(auth()->user()->address_book_id){
            $this->address_book_id = auth()->user()->address_book_id;
            $this->msg_add_default = "Default";
        }

        $this->addr_count = AddressBook::where('user_id', Auth::id())->count();

            $this->cities = City::all();
            $this->barangays = collect();
    }

    public function updatedCity($value)
    {
        $this->barangays = Barangay::where('city_id', $value)->get();
        $this->barangay = $this->barangays->first()->id ?? null;
    }

    public function render()
    {
        if($this->address_book_id){
            $address = AddressBook::findOrFail($this->address_book_id);
            if($address->barangay->city->id == 41014)
            {
                if($this->shipping_type == 'express'){
                    $this->shipping = 150;
                }
                else if($this->shipping_type == 'standard'){
                    $this->shipping = 100;
                }
            }
            else if($address->barangay->city->id == 41031)
            {
                if($this->shipping_type == 'express'){
                    $this->shipping = 200;
                }
                else if($this->shipping_type == 'standard'){
                    $this->shipping = 150;
                }
            }

        }



        $addresses = AddressBook::with('barangay.city')
        ->where('user_id', Auth::id())
        ->latest()
        ->take(5)
        ->get();

        $cartItems = Cart::with('products')->get()->where('user_id', Auth::id())
            ->map(function (Cart $items) {
                return (object)[
                    'id' => $items->product_id,
                    'user_id'=> $items->user_id,
                    'slug' => $items->products->slug,
                    'name' => $items->products->name,
                    'brand' => $items->products->brand->name,
                    'image' => $items->products->image,
                    'selling_price' => $items->products->selling_price,
                    'qty' => $items->qty,
                    'total' => ($items->qty * $items->products->selling_price),
                ];
            } 
        );

        if($cartItems->count() == 0){
            redirect(route('cart'));
        }

         $this->totalCart = $cartItems->sum('total');
         $this->totalCartWithoutTax = $cartItems->sum('total') + $this->shipping;
         $this->grandTotal = $this->totalCartWithoutTax + $this->shipping;

        return view('livewire.shop.checkout.step1', compact('addresses', 'cartItems'))->layout('layouts.user');
    }

    public function placeOrder()
    {
        $this->validate([
            'address_book_id' => 'required',
            'payment_mode' => 'required',
        ]);
                
        $cart = Cart::with('product')->where('user_id', Auth::id())->get();
        $products = Product::select('id', 'quantity')
            ->whereIn('id', $cart->pluck('product_id'))
            ->pluck('quantity', 'id');

        

        try{
            $this->resetValidation();
            DB::transaction(function () use ($cart) {

                
                if($this->shipping_type == "rush")
                {

                    //$shipping
                }
                else if($this->shipping_type == "rush")
                {

                }
                /*
                $order = Order::create([
                    'user_id' => auth()->id(),
                    'address_book_id' => $this->address_book_id/1,
                    'subtotal' => $this->totalCart,
                    'discount' => $this->discount,
                    'shippingfee' => $this->shipping,
                    'total' => $this->grandTotal - $this->discount,
                    'status' => 'pending'
                ]);*/

                $order = new Order();
                $order->user_id = auth()->id();
                $order->address_book_id = $this->address_book_id/1;
                $order->subtotal = $this->totalCart;
                $order->discount = $this->discount;
                $order->shippingfee = $this->shipping;
                $order->total = $this->grandTotal - $this->discount;
                $order->shipping_type = $this->shipping_type;

                if($this->payment_mode == 'cod'){
                    $order->status = 'ordered';
                }
                else{
                    $order->status = 'pending';
                }
                $order->save();

                foreach ($cart as $cartProduct){
                    
                    //if($cartProduct->product->quantity > $cartProduct->qty){
                    //    dd('no way');
                   // }
                    $order->products()->attach($cartProduct->product_id, [
                        'quantity' => $cartProduct->qty,
                        'user_id' => auth()->id(),
                        'price' => $cartProduct->product->selling_price,
                    ]);
                    Product::find($cartProduct->product_id)->decrement('quantity', $cartProduct->qty);
                }

                $transaction = new Transaction();
                $transaction->order_id = $order->id;
                $transaction->user_id = Auth::user()->id;
                $transaction->mode = $this->payment_mode;
                if($this->payment_mode == 'cod'){
                    $transaction->status = 'ordered';
                }
                else{
                    $transaction->status = 'pending';
                }
                $transaction->save();
               
                Cart::where('user_id', Auth::user()->id)->delete();
                $this->emit('updateCart');

                //Session::flash('orderid', $order->id);
               //dd($order->id);
               if($this->payment_mode == 'cod'){
                    $user = Auth::user();

                    $orderData = [
                        'greeting' => 'Thank you for your order!',
                        'name' => 'Hello ' . $user->name . ',',
                        'body' => ' Thank you for your order from Hipolito`s Hardware. We received your order #' . $order->id . ' on ' . $order->created_at->format('F j Y h:i A') . ' and your payment method is Cash on Delivery. We will email you once your order has been shipped. We wish you enjoy shopping with us and thank you again for choosing our store!' ,
                        'orderText' => 'View Order',
                        'orderDetails' => [
                            'id' => $order->id,
                        ],
                        'url' => url(route('user.order.details', $order->uuid )),
                        'thankyou' => ''
                    ];

                    $user->notify(new OrderNotification($orderData));

                    
                    redirect()
                    ->route('checkout.success', $order->id);
               }
                else{
                    redirect()
                    ->route('checkout')
                    ->with('orderid', $order->id);
                }
               
            });
        }
        catch (\Illuminate\Database\QueryException $exception){
            foreach ($cart as $cartProduct){
                if(!isset($products[$cartProduct->product_id]) 
                    || $products[$cartProduct->product_id] < $cartProduct->qty) {
                        Cart::where('product_id', $cartProduct->product->id)
                            ->where('user_id', Auth::id())->delete();


                        redirect()
                        ->route('cart')
                        ->with('checkout_message', $cartProduct->product->name);
                        
                    //$this->checkout_message = 'Error: Product ' . $cartProduct->product->name . ' not found in stock';
                }
            }
            
            //$this->checkout_message = "Something wrong";
            //dd("Query Exception: " . $exception->getMessage());
        }
         catch (\Exception $exception){
            
            //$this->checkout_message = "Something wrong";
            dd("General: " . $exception->getMessage());
        }
        

        

    }

    public function cancel()
    {
        
        return redirect()->to('/checkout'); 
    }

    public function showAddr()
    {
        $this->showForm = true;
        $this->addr_count = 0;
    }


    public function storeAddress()
    {
        $addrcount = AddressBook::where('user_id', Auth::user()->id)->count();

        $this->validate([
            'entry_company' => 'max:255',
            'entry_firstname' => 'required|string|max:255',
            'entry_lastname' => 'required|string|max:255',
            'entry_landmark' => 'required|string|max:255',
            'entry_street_address' => 'required|max:255',
            'entry_phonenumber' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
        ]);

        if($addrcount == 5){
            return $this->error_message = 'Please remove one of your address first!';
        }

        try{
            $this->resetValidation();
            DB::transaction(function () use ($addrcount) {
            $c_address = AddressBook::create([
                'user_id' => Auth::user()->id,
                'entry_company' => $this->entry_company,
                'entry_firstname' => $this->entry_firstname,
                'entry_lastname' => $this->entry_lastname,
                'entry_landmark' => $this->entry_landmark,
                'entry_street_address' => $this->entry_street_address,
                'barangay_id' => $this->barangay,
                'entry_phonenumber' => $this->entry_phonenumber,
            ]);

        
            if($addrcount == 0 || $this->setAddr == 1){
                $user = User::find(Auth::user()->id);
                $user->address_book_id = $c_address->id;
                $user->save();
            }
            //$transaction = Transaction::where('order_id', '=', $user_orderid)
            //$cart->update(['qty' => $cart->qty + $qty]);
            //->update(array('status' => 'cancelled'));

            $this->entry_company = '';
            $this->entry_firstname = '';
            $this->entry_lastname = '';
            $this->entry_landmark = '';
            $this->entry_street_address = '';
            $this->entry_phonenumber = '';

            $this->cities = collect();

            //session()->flash('message', 'Address Created Successfully');
            return redirect()->to('/checkout'); 
            //$this->emit('updateAddress');
            //$this->showForm = false;
        });
        }  catch (\Exception $exception){
            $this->error_message = "Something went wrong";
        }
    }

    public function deleteAddr($id)
    {
        try{
            AddressBook::findOrFail($id)->delete();
            
            $user = User::find(Auth::user()->id);
            $user->address_book_id = 0;
            $user->save();
            $this->successToast('Address Deleted Successfully!');
        } catch(\Exception $e){
            $this->errorAlert('This Address Cannot Be Deleted!');
        }
    }

}
