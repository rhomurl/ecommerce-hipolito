<?php

namespace App\Http\Livewire\Shop;

use Illuminate\Support\Facades\Auth;
use App\Models\Transaction;
use App\Models\Order;
use App\Models\User;

use Livewire\Component;

class CheckoutSuccess extends Component
{
    public function mount($id)
    {
        
        $this->order_id = $id;


    }

    public function render()
    {
        $order = Order::where('id',$this->order_id)
            ->where('user_id', Auth::id())->first();
            
        if(!$order){
            redirect()->route('home');
        }
        
        return view('livewire.shop.checkout-success', compact('order'));
    }
}
