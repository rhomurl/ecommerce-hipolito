<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use App\Models\Order;
use App\Models\AddressBook;
use Illuminate\Support\Facades\Auth;
use App\Traits\ModelComponentTrait;
use Livewire\Component;

class OrderDetails extends Component
{
    use ModelComponentTrait;
    
    public $uuid;

    public function mount($uuid)
    {
        $this->uuid = $uuid;
    }

    public function render()
    {
        //$status = 0;
        $userCheck = Order::where('uuid', $this->uuid)->get();
        $order = Order::with('transaction')->where('uuid', $this->uuid)->firstOrFail();
    
        $address = AddressBook::with('barangay.city')->where('id', $order->address_book_id)->first();
        
        return view('livewire.user.order-details', compact('order', 'address'))->extends('layouts.user-profile');
    }
}
