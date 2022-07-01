<?php

namespace App\Services;
use App\Traits\ModelComponentTrait;
use App\Models\{Order, OrderProduct, User, Product, AddressBook, Transaction};
use DB;

class OrderService
{
    use ModelComponentTrait;
    /*public function __construct( $user, $transactionID )
    {
        $this->user = $user;
        $this->transactionID = $transactionID;
    }*/

    public function getOrderData(User $user, AddressBook $address, Order $order)
    {
        //$order = Order::with('products', 'transaction')->find($order_id);
        //$address = AddressBook::with('barangay')->find($order->address_book_id);
        //$user = User::find($order->user_id);

        $orderData = [
            'email'=> $user->email,
            'order' => $order->products,
            'product_img' => [],
            'subtotal' => number_format($order->subtotal,2),
            'shippingfee' => number_format($order->shippingfee,2),
            'total' => number_format($order->total,2),
            'order_link' => route('user.order.details', $order->uuid),
            'order_id' => $order->id,
            'date' => $order->created_at->format('M d Y h:i A'),
            'shipping_method' => $order->shipping_type,
            'payment_mode' => $order->getPaymentModeAttribute(),
            'name' => $user->name,
            'phone' => $address->entry_phonenumber,
            'address' => $address->entry_street_address . ", " . $address->barangay->name . ", " .$address->barangay->city->name . ", " .
                $address->barangay->city->zip,

        ];
        foreach($order->products as $key => $product_url){
            $orderData['product_img'][$key] = $this->getProductURL($product_url->image);
        }

        return $orderData;
    }

    public function orderDetailsDelivery(Order $order, User $user){
        if($order->transaction->mode == 'cod'){
            $msg_payment = ' Kindly prepare an amount of ' . number_format($order->total, 2) . ' PHP.';
        }
        else if($order->transaction->mode == 'paypal'){
            $msg_payment = ' Make sure there is a receiver for your order.';
        }
            $orderData = [
                'greeting' => 'You order is on the way!',
                'name' => 'Hello ' . $user->name . ',',
                'body' => ' We are glad that your order #HP-' . $order->id . ' ordered on ' . $order->created_at->format('F j Y h:i A') . ' is out for delivery.' . $msg_payment .  ' Thank you again for choosing our store!' ,
                'orderText' => 'View Order',
                'subject' => 'On The Way [#HP-'.$order->id.'] - Hipolito`s Hardware',
                'url' => url(route('user.order.details', $order->uuid )),
            ];

            return $orderData;
    }

    /*
    public function countStatus($status){
        $count = Order::query();
        if($status != 'all'){
            $count = $count->where('status', $status);
        }
        return $count->count();
    }*/

    public function displayOrders($status, $method){
        $orders = Order::query()->with('user');
        
        if($status != 'all'){
            $orders = $orders->where('status',  $status);
        }

        if($method == 'display'){
            return $orders;
        }
        else if($method == 'count'){
            return $orders->count();
        }  
    }

    public function displayOrders2($status, $method, $sortDirection, $sortColumn){
        $orders = Order::query()->with('user');
        
        if($status != 'all'){
            $orders = $orders
                ->where('status',  $status)
                ->orderBy($sortColumn, $sortDirection);
        }

        if($method == 'display'){
            return $orders->orderBy($sortColumn, $sortDirection);
        }
        else if($method == 'count'){
            return $orders->count();
        }  
    }

    public function retryOrder($order, $auth_id){
        //$order = Order::where('id', $id)
        $order
        ->where('created_at', '<', now()->subMinutes(60)->toDateTimeString())
        ->where('status', 'pending')
        ->where('user_id', $auth_id)
        ->get();

        if(!$order){
            $this->errorAlert('Something Went Wrong!');
        }
        redirect()->route('checkout.step2')->with('orderid', $order->id);
    }

    public function cancelOrder($order)
    {
        $cart = OrderProduct::select("product_id", DB::raw("sum(quantity) as product_qty"))
        ->groupBy('product_id')
        ->where('order_id', $order->id)
        ->get();

        foreach ($cart as $cartProduct){
            Product::find($cartProduct->product_id)->increment('quantity', $cartProduct->product_qty);
        }

        $order->status = 'cancelled';
        $order->save();

        Transaction::where('order_id', '=', $order->id)
            ->update(array('status' => 'cancelled'));

        redirect()->route('order.cancel');
    }
}