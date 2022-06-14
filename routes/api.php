<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaypalController;
use App\Http\Controllers\FacebookBotController;
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

Route::get('/order/status/{id}/{email}', [FacebookBotController::class, 'getStatus'])
    ->middleware('throttle:5,1');

Route::get('/order/details/{id}', [FacebookBotController::class, 'getOrderDetails'])
->middleware('throttle:5,1');

Route::get('/user/verify/{email}', [FacebookBotController::class, 'checkEmail'])
->middleware('throttle:5,1');

