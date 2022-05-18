<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\AddressBook;
use PDF;
use Carbon\Carbon;

class GeneratePDF extends Controller
{
    public $order;

    public function generatePDF(Request $request, $uuid)
    {
        $order = Order::with('transaction')->where('uuid', $uuid)->firstorFail();
        $address = AddressBook::with('barangay.city')->where('id', $order->address_book_id)->first();
        /*if($order->transaction == 'paypal' && $order->status == 'ordered'){
            $ostatus = 'PAID';
        }
        else if($order->transaction == 'cod' && $order->status == 'ordered'){
            $ostatus = 'UNPAID';
        }*/


        $data = [
            'title' => 'Welcome to ItSolutionStuff.com',
            'date' => date('m/d/Y'),    
            'prod' => $order,
            'address' => $address,
            'transDate' => $order->created_at->format('m/d/Y'),
            'generatedAt' => Carbon::now()->format('M d Y h:i A'),
            'subtotal' => $order->subtotal,
            'shippingfee' => $order->shippingfee,
            'total' => $order->total,
        ];

        
        //dd($order);
        $pdf = PDF::loadView('orderPDF', $data);

        return $pdf->stream();
        //return $pdf->download('itsolutionstuff.pdf');
    }
}
