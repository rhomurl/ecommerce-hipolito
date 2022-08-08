<?php

namespace App\Http\Livewire\Shop;

use Illuminate\Support\Facades\Auth;
use App\Models\Transaction;
use App\Models\Order;
use App\Services\CheckoutService;
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
        $order = Order::with('transaction')->where('id',$this->order_id)
            ->where('user_id', Auth::id())->first();

        if($order->transaction->mode == 'grab_pay' || $order->transaction->mode == 'gcash'){
            try{
            $payment = resolve(CheckoutService::class)->verify_payment($order);
                if($payment->status != 'paid'){
                    redirect()->route('home');
                }
                $order->transaction_id = $payment->id;
                $order->save();
            } catch (\Luigel\Paymongo\Exceptions\BadRequestException $exception){
                redirect()->route('home');
            }
        }


        return view('livewire.shop.checkout-success', compact('order'))->layout('layouts.user');
    }
}
