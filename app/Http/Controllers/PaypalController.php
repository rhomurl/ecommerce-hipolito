<?php

namespace App\Http\Controllers;

use Session;
use Illuminate\Http\Request;
use App\Models\OrderProduct;
use App\Models\Order;
use App\Models\Product;
use App\Models\Transaction;
use DB;
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
        $orderId = $data['paypal_orderid'];
        $orderidz = $data['user_orderid'];

        //Init Paypal
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $token = $provider->getAccessToken();
        $provider->setAccessToken($token);

        
        $result = $provider->capturePaymentOrder($orderId);

        if($result['status'] == 'COMPLETED'){
            
            $order = Order::find($orderidz);
            $order->status = 'ordered';
            $order->transaction_id = $orderId;
            $order->save();

            $transaction = Transaction::where('order_id', '=', $orderidz)
                ->update(array('status' => 'ordered'));

            
        }

        return response()->json($result);
    }

    public function cancel(Request $request){
        $data = json_decode($request->getContent(), true);
        $user_orderid = $data['user_orderid'];

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

        $transaction = Transaction::where('order_id', '=', $user_orderid)
            ->update(array('status' => 'cancelled'));

        
        $result = [
            'response' => "Cancelled"
        ];
        return response()->json($result);

    }
}
