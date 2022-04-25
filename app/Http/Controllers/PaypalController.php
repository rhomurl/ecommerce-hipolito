<?php

namespace App\Http\Controllers;

use Session;
use App\Notifications\OrderNotification;
use Illuminate\Http\Request;
use App\Models\OrderProduct;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
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
        $user_id = $data['user_id'];
        $user = User::find($user_id);

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
            
            $orderData = [
                'greeting' => 'Thank you for your order!',
                'name' => 'Hello '. $user->name . ',',
                'body' => ' Thank you for your order from Hipolito`s Hardware. We received your order #' . $order->id . ' on ' . $order->created_at->format('F j Y h:i A') . ' and your payment method is PayPal. We will email you once your order has been shipped. We wish you enjoy shopping with us and thank you again for choosing our store!' ,
                'orderText' => 'View Order',
                'orderDetails' => [
                    'id' => $order->id,
                ],
                'url' => url(route('user.order.details', $order->uuid )),
                'thankyou' => ''
            ];

            $user->notify(new OrderNotification($orderData));

            
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
