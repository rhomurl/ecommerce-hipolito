<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use App\Models\Order;
use App\Models\AddressBook;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class OrderDetails extends Component
{
    public $order_id;

    public function mount($order_id)
    {
        $this->order_id = $order_id;
    }

    public function render()
    {
        $status = 0;
        
        $userCheck = Order::where('id', $this->order_id)
            //->where('user_id', Auth::id())
            
            ->get();

       


        $order = Order::with('transaction')->findorFail($this->order_id);
    
        $address = AddressBook::with('barangay.city')->where('id', $order->address_book_id)->first();
        
        return view('livewire.user.order-details', compact('order', 'address'))->extends('layouts.user-profile');
    }
}
