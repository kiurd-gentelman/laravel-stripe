<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StripeController extends Controller
{
    public function products(){
        $stripe = new \Stripe\StripeClient(env('STRIPE_TEST_SECRET_KEY'));

        return $stripe->products->all(['limit' => 5]);
    }


    public function productStore(Request $request): \Illuminate\Http\JsonResponse
    {
        $stripe = new \Stripe\StripeClient(env('STRIPE_TEST_SECRET_KEY'));
        $product = $stripe->products->create([
            'name' => $request->name,
        ]);

        return response()->json($product);
    }

    public function productPrice(Request $request): \Stripe\Price
    {
        $stripe = new \Stripe\StripeClient(env('STRIPE_TEST_SECRET_KEY'));

        return $stripe->prices->create([
            'unit_amount' => $request->price,
            'currency' => 'usd',
            'recurring' => ['interval' => 'month'],
            'product' => $request->product_id,
        ]);
    }

    public function planCreate(Request $request){
        $stripe = new \Stripe\StripeClient(env('STRIPE_TEST_SECRET_KEY'));
        return $stripe->plans->create([
            'amount' => (int)$request->amount,
            'currency' => 'usd',
            'interval' => 'day',
            'interval_count' => 10,
            'product' => $request->product_id,
        ]);
    }

    public function plans (){
        $stripe = new \Stripe\StripeClient(env('STRIPE_TEST_SECRET_KEY'));

        return $stripe->plans->all(['limit' => 3]);
    }

    public function customerList(){
        $stripe = new \Stripe\StripeClient(env('STRIPE_TEST_SECRET_KEY'));

        return $stripe->customers->all(['limit' => 3]);
    }

    public function customerCreate(Request $request): \Stripe\Customer
    {
        $stripe = new \Stripe\StripeClient(env('STRIPE_TEST_SECRET_KEY'));
        return $stripe->customers->create([
            'description' => $request->description,
        ]);
    }

    public function priceList(): \Stripe\Collection
    {
        $stripe = new \Stripe\StripeClient(env('STRIPE_TEST_SECRET_KEY'));

        return $stripe->prices->all(['limit' => 3]);
    }

    public function subscriptionsCreate (Request $request): \Stripe\Subscription
    {
        $stripe = new \Stripe\StripeClient(env('STRIPE_TEST_SECRET_KEY'));

        return $stripe->subscriptions->create([
            'customer' => $request->customer_id,
            'items' => [
                [
                    ['price' => $request->price_id],
                ],
            ],
        ]);
    }
}
