<?php

namespace App\Http\Controllers;

use App\Mail\OrderConfirmationMail;
use Illuminate\Http\Request;
use Mail;

class MailController1 extends Controller
{
    public function sendMail(Request $request, $email)
    {
        //$data = $request->validate([
        //    //'name'=>'required',
      //      'email'=>'required|email'
        //]);
        $orderData = [
            'email'=> $email,
        ];
 
        Mail::to($email)->send(new OrderConfirmationMail($orderData));

        $array = [
            'message' => 'Email sent!'
        ];

        return response()->json($array);
    }
}
