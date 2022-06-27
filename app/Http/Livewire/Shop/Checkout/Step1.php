<?php

namespace App\Http\Livewire\Shop\Checkout;

use DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;
//use App\Notifications\OrderNotification;
use App\Mail\OrderConfirmationMail;
use App\Traits\ModelComponentTrait;
use App\Models\{AddressBook, Barangay, Cart, City, Order, Product, Transaction, User};
use App\Services\AddressService;
use App\Services\OrderService;
use Illuminate\Support\Facades\Auth;
use App\Exceptions\AddressAttachedToOrderException;
use Livewire\Component;
use Mail;

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

    protected $messages = [
        'address_book_id.required' => 'Address is required',
        'shipping_type.required' => 'Shipping type is required',
        'payment_mode.required' => 'Payment method is required'
    ];


    public $voucher, $discount, $voucher_msg, $vouchercount, $usage_qty;
    public $address_book_id, $payment_mode, $checkout_message, $shipping, $transid;

    public function mount()
    {
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

    public function updatedAddressBookId($value)
    {
        $this->getShipping($this->shipping_type);
    }

    public function updatedShippingType($value){
        $this->getShipping($value);
    }

    public function render()
    {
        $addresses = AddressBook::with('barangay.city')
        ->where('user_id', Auth::id())
        ->latest()
        ->take(5)
        ->get();

        $cartItems = Cart::with('products')->get()->where('user_id', Auth::id())
            ->map(function (Cart $items) {
                return (object)[
                    'id' => $items->product_id,
                    //'user_id'=> $items->user_id,
                    //'slug' => $items->products->slug,
                    'name' => $items->products->name,
                    //'brand' => $items->products->brand->name,
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
         //$this->totalCartWithoutTax = $cartItems->sum('total');
         $this->grandTotal = $this->totalCart + $this->shipping;

        return view('livewire.shop.checkout.step1', compact('addresses', 'cartItems'))->layout('layouts.user');
    }

    public function placeOrder()
    {
        $cart = Cart::with('product')->where('user_id', Auth::id())->get();
        foreach ($cart as $cartProduct){
            $product = Product::find($cartProduct->product_id);
            if($product->quantity < $cartProduct->qty) {
                Cart::where('product_id', $cartProduct->product->id)->where('user_id', Auth::id())->delete();
                return redirect()->route('cart')->with('checkout_message', 'Sorry! One of the items in your cart is unavailable.');
            }
        }

        $this->validate([
            'address_book_id' => 'required',
            'payment_mode' => 'required',
            'shipping_type' => 'required',
        ]);
                
        
        try{
            $this->resetValidation();
            DB::transaction(function () use ($cart) {
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
                //$order->user_id = auth()->id();
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
               if($this->payment_mode == 'cod')
               {
                    $address = AddressBook::with('barangay')->find($order->address_book_id);
                    $orderData = resolve(OrderService::class)->getOrderData(auth()->user(), $address, $order);
                
                    Mail::to(auth()->user()->email)
                        ->send(new OrderConfirmationMail($orderData));

                    redirect()->route('checkout.success', $order->id);
               }
                else
                {
                    redirect()->route('checkout.step2')->with('orderid', $order->id);
                }
               
            });
        }
        catch (\Illuminate\Database\QueryException $exception){
            $this->checkout_message = "Something wrong";
            //dd("Query Exception: " . $exception->getMessage());
        }
         catch (\Exception $exception){
            $this->checkout_message = "Something wrong";
            //dd("General: " . $exception->getMessage());
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


            $this->entry_company = '';
            $this->entry_firstname = '';
            $this->entry_lastname = '';
            $this->entry_landmark = '';
            $this->entry_street_address = '';
            $this->entry_phonenumber = '';

            $this->cities = collect();

            //session()->flash('message', 'Address Created Successfully');
            //$this->emit('updateAddress');
            //$this->showForm = false;
            return redirect()->to('/checkout'); 

        });
        }  catch (\Exception $exception){
            //dd($exception->getMessage());
            $this->error_message = "Something went wrong";
        }
    }

    public function deleteAddr($id)
    {
        try{
            resolve(AddressService::class)->checkAddress($id);
            if(auth()->user()->address_book_id == $id){
                $user = User::find(auth()->user()->id);
                $user->address_book_id = 0;
                $user->save();
            }
            
            //$this->successToast('Address Deleted Successfully!');
            AddressBook::findOrFail($id)->delete();
        } catch(AddressAttachedToOrderException $exception){
            $this->errorAlert('Address Cannot Be Deleted!');
        }
    }

    public function getShipping($value){
        $address = AddressBook::find($this->address_book_id);
        if($address){
            if($address->barangay->city->id == 41014)
            {
                //Lipa City
                if($value == 'express'){
                    $this->shipping = 300;
                }
                else if($value == 'standard'){
                    $this->shipping = 200;
                }

                if($this->totalCart > 5000){
                    $this->shipping = 0;
                }
            }
            else if($address->barangay->city->id == 41031)
            {
                //Tanauan City
                if($value == 'express'){
                    $this->shipping = 500;
                }
                else if($value == 'standard'){
                    $this->shipping = 300;
                }

                if($this->totalCart > 8000){
                    $this->shipping = 0;
                }
            }
        }
    }

}
