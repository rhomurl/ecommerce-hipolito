<?php

namespace App\Http\Controllers;

use Srmklive\PayPal\Services\PayPal as PayPalClient;
use App\Models\Cart;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;    
use Illuminate\Http\Request;

class PaypalTest extends Controller
{
    public $order_total = 1;

    public function index()
    {
        return view('livewire.shop.paypal-test')->layout('layouts.user');
    }

    public function process(Request $request)
    {

        $provider = new PayPalClient;
            $provider->setApiCredentials(config('paypal'));
            $paypalToken = $provider->getAccessToken();

            $response = $provider->createOrder([
                "intent" => "CAPTURE",
                "application_context" => [
                    "return_url" => route('paypal.success'),
                    "cancel_url" => route('paypal.cancel'),
                ],
                "purchase_units" => [
                    0 => [
                        "amount" => [
                            "currency_code" => "PHP",
                            "value" => $this->order_total
                        ]
                    ]
                ]
            ]);

        if (isset($response['id']) && $response['id'] != null) {

            // redirect to approve href
            foreach ($response['links'] as $links) {
                if ($links['rel'] == 'approve') {
                    return redirect()->away($links['href']);
                }
            }

            return redirect()
                ->route('paypal.create')
                ->with('error', 'Something went wrong.');

        } else {
            return redirect()
                ->route('paypal.create')
                ->with('error', $response['message'] ?? 'Something went wrong.');
        }   
    }

    public function success(Request $request)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request['token']);

        if (isset($response['status']) && $response['status'] == 'COMPLETED') {
            
            Cart::where('user_id', Auth::user()->id)->delete();  
            return redirect()
                ->route('paypal.create')
                ->with('success', 'Transaction complete.');
        } 
        else if(isset($response['message']) && Str::contains($response['message'], 'Order already captured')) {
            return redirect()
                ->route('home');
        }
        else if(isset($response['message']) && Str::contains($response['message'], 'INVALID_RESOURCE_ID')) {
            return redirect()
                ->route('home');
        }
        else {
            return redirect()
                ->route('paypal.create')
                ->with('error', $response['message'] ?? 'Something went wrong.');
        }
    }

    public function cancel()
    {
        return redirect()
            ->route('paypal.create')
            ->with('error', $response['message'] ?? 'You have canceled the transaction.');
    }
}
