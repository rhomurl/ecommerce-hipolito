<?php

namespace App\Services;
use App\Traits\ModelComponentTrait;
use App\Models\{Order, User, Product, AddressBook};

class CheckoutService
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

}