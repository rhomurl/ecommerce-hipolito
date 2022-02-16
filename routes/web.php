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
use App\Http\Livewire\UserHome;
use App\Http\Livewire\User;
use App\Http\Livewire\Admin;
use App\Http\Livewire\Shop;


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

Route::get('/', UserHome::class)->name('home');
//Route::get('redirects', 'App\Http\Controllers\AuthRedirect@index')->middleware('verified');

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

Route::get('/product/{slug}', Shop\ProductDetails::class)->name('product.details');
Route::get('/search/{sdata}', Shop\SearchResult::class)->name('product.search');
Route::get('/search/category/{slug}', Shop\SearchCategory::class)->name('category.search');
Route::get('/search/brand/{slug}', Shop\SearchBrand::class)->name('brand.search');
Route::get('/cart', Shop\ShoppingCart::class)->middleware('auth')->name('cart');


Route::post('/checkout/response', 'App\Http\Livewire\Shop\Checkout@response');
Route::get('/checkout/success/{orderid}', Shop\CheckoutSuccess::class)->name('checkout.success');
Route::get('/paypal/create', 'App\Http\Controllers\PaypalTest@index')->name('paypal.create');
Route::get('/paypal/process', 'App\Http\Controllers\PaypalTest@process')->name('paypal.process');
Route::get('/paypal/success', 'App\Http\Controllers\PaypalTest@success')->name('paypal.success');
Route::get('/paypal/cancel', 'App\Http\Controllers\PaypalTest@cancel')->name('paypal.cancel');

Route::get('/checkout', Shop\Checkout\Step1::class)->middleware('check_if_user')->name('checkout.step1');
Route::get('/checkout/paypal', Shop\Checkout::class)->middleware('check_if_user')->name('checkout');

Route::name('user.')->prefix('user')->middleware(['check_if_user'])->group(function () {
    Route::get('/', User\AccountOverview::class);
    Route::get('overview', User\AccountOverview::class)->name('overview');
    Route::get('orders', User\MyOrders::class)->name('orders');
    Route::get('order/{order_id}', User\OrderDetails::class)->name('order.details');
    Route::get('edit', User\EditProfile::class)->name('edit');
    Route::get('address', User\MyAddress::class)->name('address');
    Route::get('address/create', User\AddressCreate::class)->name('address.create');
    
    Route::get('address/edit/{id}', User\AddressEdit::class)->name('address.edit');
}); 

Route::name('admin.')->prefix('admin')->middleware(['check_if_admin'])->group(function () {
    Route::get('/', Admin\AdminHome::class)->name('overview');
    Route::get('banners', Admin\BannerComponent::class)->name('banners');
    Route::get('products', Admin\ProductComponent::class)->name('products');
    Route::get('brands', Admin\BrandComponent::class)->name('brands');
    Route::get('categories', Admin\CategoryComponent::class)->name('categories');
    Route::get('usermanagement', Admin\BrandComponent::class)->name('manageuser');
    Route::get('orders', Admin\OrderUserComponent::class)->name('orders');
    Route::get('/order/{order_id}', Admin\OrderDetails::class)->name('order.details');
    Route::get('vouchers', Admin\BrandComponent::class)->name('vouchers');

}); 
