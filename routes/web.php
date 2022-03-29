<?php

use App\Http\Controllers\StripeController;
use Illuminate\Support\Facades\Route;

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
//
Route::get('/', function () {
    return view('welcome');
});

Route::get('/products', [StripeController::class, 'products']);
Route::post('/add-product', [StripeController::class , 'productStore']);
Route::post('/add-product-price', [StripeController::class , 'productPrice']);
Route::post('/create-plan', [StripeController::class , 'planCreate']);
Route::get('/plans', [StripeController::class , 'plans']);
Route::get('/price-list', [StripeController::class , 'priceList']);
Route::get('/customer-list', [StripeController::class , 'customerList']);
Route:: post('/create-customer', [StripeController::class , 'customerCreate']);
Route:: post('/create-subscriptions', [StripeController::class , 'subscriptionsCreate']);
Route::post('/payment-intent' , [StripeController::class , 'paymentIntent']);
Route::post('/payment-intent-confirm' , [StripeController::class , 'paymentIntentConfirm']);
Route::post('/payment-intent-confirm-subscription' , [StripeController::class , 'paymentIntentConfirmSubscription']);

Route::post('payment-process', [StripeController::class , 'paymentProcess']);
