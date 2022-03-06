<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;

class FacebookBotController extends Controller
{
    public $message;

    public function getStatus(Request $request, $id, $email)
    {
       
        $user = User::where('email', $email)->first();

        if ($user === null) {
            $error = "";
            $message = "User not found";
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
            
            $message = "Something went wrong!";
    
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

    //public function getStatus(Request $request)
   // {

   // }/


}
