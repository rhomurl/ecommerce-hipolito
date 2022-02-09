<?php

namespace App\Http\Livewire\User;

use Livewire\WithPagination;
use App\Models\AddressBook;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

use Notification;
use App\Models\User;
use App\Notifications\OrderNotification;

use Livewire\Component;

class MyOrders extends Component
{
    use WithPagination;
    
    public function render()
    {
        $orders = Order::with('transaction')->where('user_id', Auth::id())
            ->orderby('id', 'DESC')
            ->paginate(10);
        return view('livewire.user.my-orders', compact('orders'))->extends('layouts.user-profile');
    }

    public function paynow($id)
    {
        redirect()
            ->route('checkout')
            ->with('orderid', $id);
    }
}
