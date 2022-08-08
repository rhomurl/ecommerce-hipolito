<?php

namespace App\Http\Controllers\Checkout;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Notifications\EmptyProductNotification;
use Luigel\Paymongo\Facades\Paymongo;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;


class PayMongoPayment extends Controller
{
    public function webhook(Request $request){
        if(isset($request->data)){
            $type = $request->data['attributes']['type'];
            $amount = $request->data['attributes']['data']['attributes']['amount'];
            $id = $request->data['attributes']['data']['id'];
        }
        if(isset($type) == 'source.chargeable' || isset($type) == 'payment.paid' || isset($type) == 'payment.failed'){
            try{
                $payment = Paymongo::payment()
                ->create([
                    'amount' => $amount,
                    'currency' => 'PHP',
                    'description' => 'Testing payment',
                    'statement_descriptor' => 'Test Paymongo',
                    'source' => [
                        'id' => $id,
                        'type' => 'source'
                    ]
                ]);

                //request log via fiile or console
                $admins = User::role(['admin','super-admin'])->get();
                    $productData = [
                        'name' => 'Hello admin!',
                        'product_name' => 'Webhook sent at: '.now(),
                        'product_id' => 1
                       // 'url' => url(route('user.order.details', $order->uuid )),
                    ];
        
                foreach($admins as $admin){
                        $admin->notify(new EmptyProductNotification($productData));
                }
                
                $this->info('Email Sent to Admin!');
                
            } catch(\Luigel\Paymongo\Exceptions\NotFoundException $exception){

                $e = $exception->getMessage();
                $i = json_decode($e);
                $err_code = $i->errors[0]->code;
                $err_detail = $i->errors[0]->detail;
                return response()->json(['code' => $err_code, 'detail' => $err_detail]);
            }
            
        }
        else{
            return response()->json(['message' => 'Success']);
        }
    }

    public function payGcash(Request $request){
        $source = Paymongo::source()->create([
            'type' => 'grab_pay',
            'amount' => 100.00,
            'currency' => 'PHP',
            'redirect' => [
                'success' => route('checkout.success', 7),
                'failed' => route('order.cancel')
            ]
        ]);
        
        $id = $source->id;
        $amount = $source->amount;
        $checkout_url = $source->redirect['checkout_url'];
        return response()->json(['id' => $id, 'amount' => $amount, 'checkout_url' => $checkout_url]);
        

    }
    
    public function create_payment(Request $request){
        $payment = Paymongo::payment()
            ->create([
            'amount' => 100.00,
            'currency' => 'PHP',
            'description' => 'Testing payment',
            'statement_descriptor' => 'Test Paymongo',
            'source' => [
                'id' => $request->id,
                'type' => 'source'
            ]
        ]);
        dd($payment);

    }
    
    public function payment_method(Request $request){
        /*$paymentMethod = Paymongo::paymentMethod()->create([
            'type' => 'card',
            'details' => [
                'card_number' => '4343434343434345',
                'exp_month' => 12,
                'exp_year' => 25,
                'cvc' => "123",
            ],
            'billing' => [
                'address' => [
                    'line1' => 'Somewhere there',
                    'city' => 'Cebu City',
                    'state' => 'Cebu',
                    'country' => 'PH',
                    'postal_code' => '6000',
                ],
                'name' => 'Rigel Kent Carbonel',
                'email' => 'rigel20.kent@gmail.com',
                'phone' => '0935454875545'
            ],
        ]);*/
        $paymentMethod = Paymongo::paymentMethod()
    ->create([
        'type' => 'paymaya',  // <--- and payment method type should be paymaya
        'billing' => [
            'address' => [
                'line1' => 'Somewhere there',
                'city' => 'Cebu City',
                'state' => 'Cebu',
                'country' => 'PH',
                'postal_code' => '6000',
            ],
            'name' => 'Rigel Kent Carbonel',
            'email' => 'rigel20.kent@gmail.com',
            'phone' => '0935454875545',
        ],
    ]);
        dd($paymentMethod);

    }
    public function payment_intent(Request $request){
        
        $paymentIntent = Paymongo::paymentIntent()->create([
            'amount' => 100,
            'payment_method_allowed' => [
                'paymaya', 'card'
            ],
            'payment_method_options' => [
                'card' => [
                    'request_three_d_secure' => 'automatic'
                ]
            ],
            'description' => 'This is a test payment intent',
            'statement_descriptor' => 'LUIGEL STORE',
            'currency' => "PHP",
        ]);
        //dd($paymentIntent);
        //pi_JGGtxJXZC9VYPGycF2kXo5uq_client_aikGURfv7CtRm7mTmN6Sc8Nx
        //

        dd($paymentIntent);
    }

    public function process_cc(Request $request){
        $paymentIntent = Paymongo::paymentIntent()->find($request->pi);
        $successfulPayment = $paymentIntent->attach($request->pm, route('checkout.success', 7));
        //$paymentIntent = Paymongo::paymentIntent()->find($request->pi);
        //Attached the payment method to the payment intent 
        //$successfulPayment = $paymentIntent->attach($request->pm);
        dd($successfulPayment);
    }
}
