<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Webhook;
use App\Models\Item; 
use App\Models\Bank;
use App\Models\Transaction;
use App\Models\TempTransaction;

class WebhookController extends Controller
{
    public function handle(Request $request)
    {
        $payload = $request->getContent();
        $signature = $request->header('Stripe-Signature');
        $endpoint_secret = env('STRIPE_WEBHOOK_SECRET'); // Add your webhook secret in services.php

        try {
            $event = Webhook::constructEvent($payload, $signature, $endpoint_secret);
        } catch (\UnexpectedValueException $e) {
            // Invalid payload
            return response()->json(['error' => 'Invalid payload'], 400);
        } catch (\Stripe\Exception\SignatureVerificationException $e) {
            // Invalid signature
            return response()->json(['error' => 'Invalid signature'], 400);
        }

        // Handle the event
        switch ($event['type']) {
            case 'payment_intent.created':
                $paymentIntent = $event['data']['object']; // contains a \Stripe\PaymentIntent
               
                break;
            case 'payment_intent.succeeded':
                $paymentIntent = $event['data']['object'];
              
                \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
                $checkoutSessions = \Stripe\Checkout\Session::all(['payment_intent' => $paymentIntent['id']]);

                $sessId = null;
                foreach ($checkoutSessions->data as $session) {
                    $sessId = $session->id;
                }

                $payment = TempTransaction::where('session_ref', $sessId)->first();
                
                if($payment){
                    $payment->update([
                        'payment_ref' => $paymentIntent['id'],
                        'status' => $paymentIntent['status']
                    ]);      
                }

                break;
            case 'payment_intent.payment_failed':
                $paymentIntent = $event['data']['object'];
                // Handle failed payment here
                break;
            case 'checkout.session.completed':
                $checkoutData = $event['data']['object'];
                $item = Item::where('uuid', $checkoutData['metadata']['uuid'])->first();
                $transaction =Transaction::create([
                    'transaction_number' => $checkoutData['payment_intent'],
                    'user_id' => $checkoutData['metadata']['user_id'],
                    'seller_id' => $item->user_id,
                    'items_quantity' => 1,
                    'service_fee_percentage' => $checkoutData['metadata']['percentage'],
                    'service_fee_amount' => $checkoutData['metadata']['service_fee'],
                    'subtotal_amount' => $checkoutData['metadata']['sub_total'],
                    'total_amount' => $checkoutData['metadata']['total_amount'],
                    'status' => 1
                ]);

                $item->update([
                    'status' => Item::STATUS_SOLD
                ]);

                TransactionItem::create([
                    'transaction_id' => $transaction->id,
                    'item_id' => $item->id
                ]);

                break;    

            case 'account.application.authorized':    
                $paymentIntent = $event['data']['object'];
                break;
            // Add more event types as needed
            default:
                // Unexpected event type
                return response()->json(['error' => 'Unhandled event type'], 400);
                
        }

        return response()->json(['status' => 'success']);
    }
}
