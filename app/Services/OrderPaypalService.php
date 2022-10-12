<?php

namespace App\Services;
use Illuminate\Support\Facades\Http;

use App\Models\Order;

class OrderPaypalService {

    public function getPaypalDetails($id)
    {
        $client_id = config('paypal.live.client_id');
        $client_secret = config('paypal.live.client_secret');

        $order = Order::where('id', $id)->first();

        
        $credentials = Http::withBasicAuth($client_id, $client_secret)
        ->asForm()
        ->post('https://api-m.paypal.com/v1/oauth2/token', [
            'grant_type' => 'client_credentials',
        ])->json();

        $response = Http::withHeaders([
            'Authorization' => 'Bearer '.$credentials['access_token']
        ])->get('https://api.paypal.com/v2/checkout/orders/' . $order->transaction_id)
        ->json();

        return $response;
    }
}