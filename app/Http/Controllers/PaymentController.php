<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Charge;
use Stripe\StripeClient;
use Stripe\Token;

class PaymentController extends Controller
{
    public function processStripePayment(Request $request)
    {

        $stripe = Stripe::setApiKey(env('STRIPE_SECRET'));
        try {
            $charge = Charge::create([
                'amount' => 10000, // Amount in cents
                'currency' => 'aed',
                // 'source' => $request->stripeToken,
                'source' => 'tok_mastercard',
                'description' => 'Test Payment By Ian Pogi2',
            ]);
            
        } catch (\Exception $e) {
            return response(['message' => $e->getMessage()], 400);
        }
    }

  
}
