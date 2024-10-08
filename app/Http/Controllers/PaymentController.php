<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\StripeClient;
use Stripe\Charge;
use App\Models\Item;
use App\Models\ItemBidding;
use App\Models\Transaction;
use App\Models\TransactionItem;
use App\Models\TempTransaction;
use App\Http\Requests\Payment\StripeAccountRequest;

class PaymentController extends Controller
{
    public function createStripeAccount(StripeAccountRequest $request)
    {

        $param = $request->validated();

        $stripeClient = new StripeClient(env('STRIPE_SECRET'));

        try {
            $user = auth('auth-api')->user();

            // Create a Standard connected account
            $account = $stripeClient->accounts->create([
                'type' => 'standard',
                'country' => 'AE',
                'email' => $request->email,
                'business_type' => 'company'
            ]);

            $link = $stripeClient->accountLinks->create([
                'account' => $account->id,
                'refresh_url' => 'http://localhost:5173/my-profile',
                'return_url' => 'http://localhost:5173/my-profile',
                'type' => 'account_onboarding',
            ]);
            $user->vendor->stripe_id = $account->id;
            $user->vendor->update();

            return response([
                'data' => $link,
                'message' => 'Stripe Account Successfully Created.', // for indication only
            ]);

        } catch (\Exception $e) {
            return response(['message' => $e->getMessage()], 400);
        }
    }

    /**
     * Checkout via stripe
     * StoreCheckoutRequest $request
     */ 
    public function checkout(Item $item)
    {
   
        $stripeClient = new StripeClient(env('STRIPE_SECRET')); // initiailize
        $user = auth('auth-api')->user();
        try {
            
            if($item->status == Item::STATUS_BID_ACCEPTED){
                $offer = ItemBidding::where('seller_id', $item->user_id)->where('item_id', $item->id)->where('buyer_id', auth('auth-api')->user()->id)->first();
                $asking_price = (int) (string) ((float) preg_replace("/[^0-9.]/", "", $offer->asking_price) * 100);
                $fees = ($asking_price * $item->total_fee_breakdown['platform_fee_percentage_value']) / 100;
                $total = $asking_price + $fees;
            }
            $total = (int) (string) ((float) preg_replace("/[^0-9.]/", "", $item->total_fee_breakdown['total']) * 100);
            $fees = (int) (string) ((float) preg_replace("/[^0-9.]/", "", $item->total_fee_breakdown['platform_fee']) * 100);
            $stripe_id = $item->user->vendor->stripe_id;
            $check = $stripeClient->checkout->sessions->create([
                'line_items' => [
                    [
                        'price_data' => [
                            'currency' => 'aed',
                            'product_data' => ['name' => $item->item_name],
                            'unit_amount' => $total
                        ],
                        'quantity' => 1, // static for now
                    ],
                ],
                'payment_intent_data' => [
                    'application_fee_amount' => $fees,
                    'transfer_data' => ['destination' => $stripe_id],
                ],
                'mode' => 'payment',
                'success_url' => 'http://localhost:5173/payment-success?session_id={CHECKOUT_SESSION_ID}&item='.$item->uuid.'',
                'metadata' => [ // custom data
                    'uuid' =>  $item->uuid,
                    'user_id' => $user->id, // buyer
                    'percentage' => $item->total_fee_breakdown['platform_fee_percentage_value'],
                    'service_fee' => $fees,
                    'sub_total' => $total,
                    'total_amount' => $total
                ],
            ]);
            // // The session ID is now in $session->id
            // $sessionId = $check->id;
            // $paymentId = $check->payment_intent;
            // // return $paymentId;
            // $data = $stripeClient->checkout->sessions->update(
            //     $sessionId,
            //     [
            //         'metadata' => [
            //             'uuid' => $item->uuid,
            //             'session' => $paymentId, // Store the session ID here
            //         ],
            //     ]
            // );

            // // ]);
            // create temporary
            TempTransaction::create([
                'session_ref' => $check->id,
                'status' => $check->status
            ]);
            // return $data;

            $item->update([
                'status' => Item::STATUS_PROCESSING_PAYMENT
            ]);

            return response([
                'stripe_url' => $check->url,
                'message' => 'Stripe URL Successfully generated.', // for indication only
            ]);
        } catch (\Exception $e) {
            return response(['message' => $e->getMessage()], 400);
        }
    }

    /**
     * Get Transaction cs_test_a1ZLtKhK50ifMgQgTZULpTHkUJA0NVgICX7jXMkfo7qxlLguE9BZkqx2Kq
     */
    public function getTransactionViaSession(Request $request, $sessionId)
    {
        $stripeClient = new StripeClient(env('STRIPE_SECRET')); // initialize
        // $access = Stripe::setApiKey(env('STRIPE_SECRET'));
        
        try {
            // $data = $stripeClient->checkout->sessions->allLineItems(
            //     $sessionId,
            //     []
            // );
            // $data = $stripeClient->checkout->sessions->retrieve(
            //     $sessionId,
            //     []
            // );

            // $data = $stripeClient->paymentIntents->retrieve(
            //     'pi_3Q4In3Kg4tFvmg1f1TUd0tHF',
            //     []
            // );

            // $data = $stripeClient->applicationFees->retrieve(
            //     'fee_1Px2PY4Gr9MILG4OuFXz8rUt',
            //     []
            // );

            // $data = $stripeClient->transfers->retrieve(
            //     'group_pi_3Px2PUKg4tFvmg1f12D3xndC',
            //     []
            // );

            // $data = \Stripe\BalanceTransaction::retrieve('txn_1Px2PaKg4tFvmg1fR17WkeJu');

            // $data = $stripeClient->balanceTransaction->retrieve(
            //     'txn_1Px2PaKg4tFvmg1fR17WkeJu',
            //     []
            // );
            return $data;
        } catch (\Exception $e) {
            return response(['message' => $e->getMessage()], 400);
        }
    }

    /**
     * Save Transaction after session
     */
    public function saveTransaction(Request $request)
    {
        // return $request;
        $stripeClient = new StripeClient(env('STRIPE_SECRET')); // initialize
        
        try {
            $item = Item::where('uuid', $request->item_id)->first();
            
            $checkout = $stripeClient->checkout->sessions->retrieve(
                $request->session_id,
                []
            );

            $payment = $stripeClient->paymentIntents->retrieve(
                $checkout->payment_intent,
                []
            );
            
            $transactionNumber = $checkout->payment_intent;

            $transaction = Transaction::create([
                'transaction_number' => $transactionNumber,
                'user_id' => auth()->user()->id,
                'seller_id' => $item->user->id,
                'items_quantity' => 1,
                'service_fee_percentage' => $item->total_fee_breakdown['platform_fee_percentage_value'],
                'service_fee_amount' => $item->total_fee_breakdown['platform_fee'],
                'subtotal_amount' => number_format(($payment->amount_received /100), 2, '.', ' '),
                'total_amount' => number_format(($payment->amount_received /100), 2, '.', ' '),
                'status' => 1 // paid (default)
            ]);

            
            TransactionItem::create([
                'transaction_id' => $transaction->id,
                'item_id' => $item->id,
            ]);

            $item->status = Item::STATUS_SOLD;
            $item->update();

            return response([
                'data' => $transaction,
                'message' => 'Successfully Paid.', // for indication only
            ]);
           
        } catch (\Exception $e) {
            return response(['message' => $e->getMessage()], 400);
        }
    }

}
