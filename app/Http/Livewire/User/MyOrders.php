<?php

namespace App\Http\Livewire\User;

use Carbon\Carbon;
use Livewire\WithPagination;
use App\Models\Order;
use App\Notifications\OrderNotification;
use App\Services\OrderService;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Traits\ModelComponentTrait;
use Illuminate\Support\Facades\Auth;
use Notification;
use Livewire\Component;

class MyOrders extends Component
{
    use WithPagination;
    use ModelComponentTrait;
    use LivewireAlert;

    public function render()
    {
        $orders = Order::with('transaction')
            ->where('user_id', Auth::id())
            ->orderby('id', 'DESC')
            ->paginate(5);
        return view('livewire.user.my-orders', compact('orders'))->extends('layouts.user-profile');
    }

    public function paynow(Order $order)
    {
        if($order->created_at <= now()->subMinutes(60) || $order->user_id != Auth::id()){
            $this->errorAlert('Something Went Wrong!');
        }else{
            $order = resolve(OrderService::class)->retryOrder($order, Auth::id());
        }
    }

    public function cancelOrder(Order $order){
        if($order->status != 'pending' && $order->user_id != Auth::id()){
            $this->errorAlert('Something Went Wrong!');
        }
        else{
            resolve(OrderService::class)->cancelOrder($order, Auth::id());
        }
    }
}
