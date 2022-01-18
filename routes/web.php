<?php

use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Livewire\Auth\Login;
use App\Http\Livewire\Auth\Passwords\Confirm;
use App\Http\Livewire\Auth\Passwords\Email;
use App\Http\Livewire\Auth\Passwords\Reset;
use App\Http\Livewire\Auth\Register;
use App\Http\Livewire\Auth\Verify;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Admin;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::view('/', 'welcome')->name('home');
Route::get('redirects', 'App\Http\Controllers\AuthRedirect@index')->middleware('verified');

Route::middleware('guest')->group(function () {
    Route::get('login', Login::class)
        ->name('login');

    Route::get('register', Register::class)
        ->name('register');
});

Route::get('password/reset', Email::class)
    ->name('password.request');

Route::get('password/reset/{token}', Reset::class)
    ->name('password.reset');

Route::middleware('auth')->group(function () {
    Route::get('email/verify', Verify::class)
        ->middleware('throttle:6,1')
        ->name('verification.notice');

    Route::get('password/confirm', Confirm::class)
        ->name('password.confirm');
});

Route::middleware('auth')->group(function () {
    Route::get('email/verify/{id}/{hash}', EmailVerificationController::class)
        ->middleware('signed')
        ->name('verification.verify');

    Route::post('logout', LogoutController::class)
        ->name('logout');
});


Route::name('admin.')->prefix('admin')->middleware(['check_if_admin'])->group(function () {
    Route::get('/', Admin\AdminHome::class)->name('overview');
    Route::get('banners', Admin\BannerComponent::class)->name('banners');
    Route::get('products', Admin\ProductComponent::class)->name('products');
    Route::get('brands', Admin\BrandComponent::class)->name('brands');
    Route::get('categories', Admin\CategoryComponent::class)->name('categories');
    Route::get('usermanagement', Admin\BrandComponent::class)->name('manageuser');
    Route::get('orders', Admin\BrandComponent::class)->name('orders');
    Route::get('/order/{order_id}', Admin\BrandComponent::class)->name('order.details');
    Route::get('vouchers', Admin\BrandComponent::class)->name('vouchers');

}); 
