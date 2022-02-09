<?php

namespace App\Http\Controllers;

use Session;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Transaction;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PaypalController extends Controller
{
    public function create(Request $request){
        $data = json_decode($request->getContent(), true);
        $total = $data['total'];
        //$total = $data['total'];
        
        //Init PayPal
        $provider = new PayPalClient;
        //$provider = PayPalClient::setProvider();
        $provider->setApiCredentials(config('paypal'));
        $token = $provider->getAccessToken();
        $provider->setAccessToken($token);

        $order = $provider->createOrder([
            "intent" => "CAPTURE",
            "purchase_units" => [
                0 => [
                    "amount" => [
                        "currency_code" => "PHP",
                        "value" => $total
                    ]
                ]
            ]
        ]);

        return response()->json($order);
    }

    public function capture(Request $request){
        $data = json_decode($request->getContent(), true);
        $orderId = $data['orderId'];
        $orderidz = $data['orderidz'];

        //Init Paypal
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $token = $provider->getAccessToken();
        $provider->setAccessToken($token);

        
        $result = $provider->capturePaymentOrder($orderId);

        if($result['status'] == 'COMPLETED'){
            $order = Order::find($orderidz);
            $order->status = 'ordered';
            $order->save();

            $transaction = Transaction::where('order_id', '=', $orderidz)
                ->update(array('status' => 'ordered'));
           
        }

        return response()->json($result);
    }
}
