<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Transaction;
use App\Models\AddressBook;
use App\Traits\ModelComponentTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


class FacebookBotController extends Controller
{
    public $message;
    use ModelComponentTrait;

    public function getStatus(Request $request, $id, $email)
    {
        //last 4 char string
        //substr($dynamicstring, -4);
        $key = "s0WBJhAfLbdgTbyVVDX2SYQdsPdsJ9CA";
        //$vv = $request->header('X-Hipolito');
        
        $user = User::where('email', $email)->first();

        if ($user === null) {
            $error = "";
            $message = "User not found";
        }
        else if($request->header('X-Hipolito') != $key){
            return response()->json(['message' => 'Something went wrong!', 'code' => '403']);
        }
        else if($user){
            $order = Order::where('id', $id)
                ->where('user_id', $user->id)
                ->first();

            if($order === null){
                $message = "Order ID or User is incorrect.";
            }
            else{
                $message = "Hello {{first name}}! Your order #". $id  ." is " . $order->status . ".";
                $error = "";
            }
        }
        else{
            
            return response()->json(['message' => 'Something went wrong!', 'code' => '404']);
    
        }
        
        //$message = "User not found.";
        //$message = "Email or order id infomration is incorrect.";
        
    
        $myArray = 
        [
            "set_attributes" => 
                [
                    "error" => $error,
                ],
            'messages' => [
                [
                    "text" => $message,
                ],
            ]
        ];
        return response()->json($myArray);
    }

    public function checkEmail(Request $request, $email){
        $user = User::where('email', $email)->first();

        if(!$user){
            $error = 'true';
            $msg = 'Email not found';
        }
        else{
            $error = 'false';
            $msg = '';
        }
        $array = [
            "set_attributes" => 
                [
                    "error" => $error,
                ],
            'messages' => [
                [
                    "text" => $msg,
                ],
            ]
        ];

        return response()->json($array);
    }

    public function getOrderDetails(Request $request, $id){
        $key = "s0WBJhAfLbdgTbyVVDX2SYQdsPdsJ9CA";

        if($request->header('X-Hipolito') != $key){
            return response()->json(['message' => 'Something went wrong!', 'code' => '403']);
        }
        //X-RateLimit-Remaining
        /*if($response->status() == 429){
            return response()->json(['message' => 'Something went wrong! Please try again after 60 seconds', 'code' => '429']);
        }*/

        $order = Order::findorFail($id);
        $user = User::findorFail($order->user_id);
        $transaction = Transaction::where('order_id', $order->id)->first();
        $address = AddressBook::findorFail($order->address_book_id);
        $order_products = OrderProduct::where('order_id', $order->id)->get();

        $array = [
            'messages' => [
                [
                'attachment' => [
                    'type' => 'template',
                    'payload' => [
                        'template_type' => "receipt",
                        'recipient_name' => "".$user->name."", //
                        'order_number' => "".$order->id."", //
                        'currency' => 'PHP',
                        'payment_method' => $transaction->mode,
                        'order_url' => route('user.order.details', $order->uuid),
                        'timestamp' => "".$order->created_at->getTimestamp()."", //
                        'address' => [
                            'street_1' => $address->entry_street_address,
                            'street_2' => "",
                            'city' => $address->barangay->city->name,
                            'postal_code' => $address->barangay->city->zip,
                            'state' => 'CA',
                            'country' => 'PH'
                        ],
                        'summary' => [
                            'subtotal' => $order->subtotal,
                            'shipping_cost' => 0,
                            'total_tax' => 0,
                            'total_cost' => $order->total
                        ],
                        /*'adjustments' => [
                            [
                                'name' => "test",
                                'amount' => 1
                            ]
                        ],*/
                        'elements' => []
                        ],
                    ],
                ]
            ],
        ];

        foreach ($order_products as $key => $order_product) {
            $array['messages'][0]['attachment']['payload']['elements'][$key] = [
                'title' => $order_product->product->name,
                'subtitle' => '',
                'quantity' => $order_product->quantity,
                'price' => $order_product->price,
                'currency' => "PHP",
                'image_url' => $this->getProductURL($order_product->product->image)
            ];
        }

        return response()->json($array);
        //return $array;
    }

    //public function getStatus(Request $request)
   // {

   // }/


}
