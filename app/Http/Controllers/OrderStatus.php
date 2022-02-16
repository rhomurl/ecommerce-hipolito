<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderStatus extends Controller
{
    public function getStatus(Request $request, $id)
    {
        $order = Order::where('id', $id)->firstorFail();
        
        $myArray = [
            'messages' => [
                [
                    "text" => "Hello {{first name}}! Your order #". $id  ." is " . $order->status . ".",
                ],
            ]
        ];
        return response()->json($myArray);
    }
}
