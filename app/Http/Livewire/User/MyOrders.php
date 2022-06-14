<?php

namespace App\Http\Livewire\User;

use Carbon\Carbon;
use Livewire\WithPagination;
use App\Models\AddressBook;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Transaction;
use App\Models\Product;
use DB;
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
            ->paginate(5);
        return view('livewire.user.my-orders', compact('orders'))->extends('layouts.user-profile');
    }

    public function paynow($id)
    {
        $order = Order::where('status', 'pending')
            ->where('id', $id)
            ->where('created_at', '<=', now()->subMinutes(60)->toDateTimeString())
            ->get();
        
        if($order){
            redirect()
                ->route('checkout.step2')
                ->with('orderid', $id);
        }
        
        
    }

    public function cancelOrder($user_orderid){
        $cart = OrderProduct::select("product_id", DB::raw("sum(quantity) as product_qty"))
        ->groupBy('product_id')
        ->where('order_id', $user_orderid)
        ->get();

        foreach ($cart as $cartProduct){
            Product::find($cartProduct->product_id)->increment('quantity', $cartProduct->product_qty);
        }

        $order = Order::find($user_orderid);
            $order->status = 'cancelled';
            $order->save();

        Transaction::where('order_id', '=', $user_orderid)
            ->update(array('status' => 'cancelled'));

        redirect()->route('order.cancel');
    }
}
