<?php

namespace App\Http\Livewire\Shop\Checkout;

use App\Models\Order;
use App\Services\OrderService;
use Illuminate\Support\Facades\Auth;

use Livewire\Component;

class OrderConfirm extends Component
{
    public $order;

    public function mount(Order $order)
    {
        /*
            ! : Please renable the code below and test again.

        */
       // if($order->status != 'pending' || $order->status = 'cancelled'){
         //   abort(404);
        //}
    }

    public function render()
    {
        return view('livewire.shop.checkout.order-confirm');
    }

    public function paynow(Order $order){
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
            resolve(OrderService::class)->cancelOrder($order);
        }
    }

    
}
