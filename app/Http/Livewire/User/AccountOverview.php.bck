<?php

namespace App\Http\Livewire\User;

use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use Livewire\Component;


class AccountOverview extends Component
{
    public function render()
    {
        $orders = Order::where('user_id', Auth::id())->limit(3)->latest()->get();
        $order_count = Order::where('user_id', Auth::id())->count();
        $pro_orders = Order::where('user_id', Auth::id())
        ->where('status', 'processing')
        ->count();
        $shpd_orders = Order::where('user_id', Auth::id())
        ->where('status', 'otw')
        ->count();
        $deliveredorders = Order::where('user_id', Auth::id())
        ->where('status', 'delivered')
        ->count();
        return view('livewire.user.account-overview', compact('orders', 'order_count', 'pro_orders', 'shpd_orders', 'deliveredorders'))->layout('layouts.user-profile');
    }
}
