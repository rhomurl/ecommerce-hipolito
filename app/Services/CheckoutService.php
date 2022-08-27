<?php

namespace App\Services;

use Luigel\Paymongo\Facades\Paymongo;
use App\Models\Order;
use App\Models\AddressBook;

class CheckoutService {

    /*
    public function payment($order, $payment_mode){

        $new_total = str_replace('.','', $order->total);

        $source = Paymongo::source()->create([
            'type' => $payment_mode,
            'amount' => $new_total,
            'currency' => 'PHP',
            'redirect' => [
                'success' => route('checkout.success', $order->id),
                'failed' => route('order.cancel')
            ]
        ]);
        
        $order = Order::find($order->id);
        $order->status = 'ordered';
        $order->transaction_id = $source->id;
        $order->save();

        $data = [
            'id' => $source->id,
            'checkout_url' => $source->redirect['checkout_url'],
        ];
        return $data; 
    }

    public function verify_payment($order){

        $payment = Paymongo::payment()
            ->create([
            'amount' => $order->total,
            'currency' => 'PHP',
            'description' => 'Testing payment',
            'statement_descriptor' => 'Test Paymongo',
            'source' => [
                'id' => $order->transaction_id,
                'type' => 'source'
            ]
        ]);

        return $payment;
    }
    */
    

    public function getShipping($add_id, $value, $total){
        $address = AddressBook::find($add_id);
        if($address){
            if($address->barangay->city->id == 41014)
            {
                //Lipa City
                if($value == 'express'){
                    return '300';
                }
                else if($value == 'standard'){
                    return '200';
                }

                if($value =='pickup' || $total > 5000){
                    return '0';
                }
            }
            else if($address->barangay->city->id == 41031)
            {
                //Tanauan City
                if($value == 'express'){
                    return '500';
                }
                else if($value == 'standard'){
                    return '300';
                }

                if($value =='pickup' || $total > 8000){
                    return '0';
                }
            }
        }
    }

}