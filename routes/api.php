<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaypalController;
use App\Http\Controllers\FacebookBotController;
use App\Http\Resources\OrderResource;
use App\Http\Resources\OrderCL;
use App\Models\Order;
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

//Route::get('/orders/{order}', function(Order $order) {
  //  return new OrderResource($order);
//});
Route::get('/orders', function() {
    return OrderResource::collection(Order::all());
});

//Route::get('/order/{id}', function ($id) {
 //   return new Order(Order::findOrFail($id));
//});

Route::get('/order/status/{id}/{email}', [FacebookBotController::class, 'getStatus'])
    ->middleware('throttle:5,1');

Route::get('/order/status/test', [FacebookBotController::class, 'getOrderDetails'])
->middleware('throttle:5,1');

Route::get('/order/{id}', function ($id) {
    return new OrderResource(Order::findOrFail($id));
});