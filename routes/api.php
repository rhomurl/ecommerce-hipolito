<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaypalController;
use App\Http\Controllers\FacebookBotController;
use App\Models\Order;
use App\Http\Controllers\Checkout;
use App\Http\Livewire\Shop;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'paypal'], function(){
    Route::post('/order/create', [PaypalController::class, 'create']);
    Route::post('/order/capture', [PaypalController::class, 'capture']);
    Route::post('/order/cancel', [PaypalController::class, 'cancel']);
});

Route::get('/order/status/{id}/{email}', [FacebookBotController::class, 'getStatus'])
    ->middleware('throttle:5,1');

Route::get('/order/details/{id}', [FacebookBotController::class, 'getOrderDetails'])
->middleware('throttle:5,1');

Route::get('/user/verify/{email}', [FacebookBotController::class, 'checkEmail'])
->middleware('throttle:5,1');

Route::post('user/sendEmailInquiry', [FacebookBotController::class, 'sendEmailInquiry'])
    ->middleware('throttle:5,1');

/*
Route::get('/payment', [Checkout\PayMongoPayment::class, 'test'])->name('payment1');
Route::get('/payment/webhook', [Checkout\PayMongoPayment::class, 'webhook'])->name('webhook');
Route::post('/payment/webhook', [Checkout\PayMongoPayment::class, 'webhook'])->name('webhook');
Route::get('/payment/gcash', [Checkout\PayMongoPayment::class, 'payGcash'])->name('pay_gcash');
Route::get('/payment/pay', [Checkout\PayMongoPayment::class, 'create_payment'])->name('pay');

Route::get('/payment/intent', [Checkout\PayMongoPayment::class, 'payment_intent'])->name('payment.intent');
Route::get('/payment/method', [Checkout\PayMongoPayment::class, 'payment_method'])->name('payment.method');
Route::get('/payment/process_cc', [Checkout\PayMongoPayment::class, 'process_cc'])->name('payment.process_cc');
*/