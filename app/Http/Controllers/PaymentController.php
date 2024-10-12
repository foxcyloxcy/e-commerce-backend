<?php

namespace App\Http\Controllers;

use App\Http\Requests\Bank\StoreUserBankRequest;
use App\Models\Item;
use App\Models\ItemBidding;
use App\Models\TempTransaction;
use App\Models\Transaction;
use App\Models\TransactionItem;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\StripeClient;
use App\Models\VendorBank;

class PaymentController extends Controller
{
    public function createMamoPayAccount(StoreUserBankRequest $request)
    {
        $param = $request->validated();

        $user = auth('auth-api')->user();

        try {
            $client = new \GuzzleHttp\Client();

            $check = VendorBank::where('user_id', auth('auth-api')->user()->id)->first();

            if (empty($check)) { 
                $response = $client->request('POST', env('MAMOPAY_URL') . '/accounts/recipients', [
                    'json' => [
                        'recipient_type' => 'individual',
                        'relationship' => 'customer',
                        'bank' => [
                            'iban' => $param['iban'],                // IBAN from $param
                            'country' => 'AE', // Optional country, defaults to 'AE'
                            'account_number' => $param['account_number'],
                            'name' => $param['bank_name'],
                            'address' => $param['bank_address'],
                            'bic_code' => $param['bic_code'],
                        ],
                        'email' => $user->email,
                        'first_name' => $user->first_name,
                        'last_name' => $user->last_name,
                        'reason' => 'Payout for Seller',
                    ],
                    'headers' => [
                        'Authorization' => 'Bearer '.env('MAMOPAY_SECRET'),
                        'Accept' => 'application/json',
                        'Content-Type' => 'application/json',
                    ],
                ]);

                $rawData = json_decode($response->getBody(), true);                
                // create vendor account
                VendorBank::create([
                    'user_id' => auth('auth-api')->user()->id,
                    'account_id' => $rawData['identifier'],
                    'iban' => $param['iban'],
                    'bic_code' => $param['bic_code'],
                    'account_fullname' => $param['account_fullname'],
                    'account_number' => $param['account_number'],
                    'bank_name' => $param['bank_name'],
                    'bank_address' => $param['bank_address']
                ]);

            } else {

                if(empty($check->account_id)){
                    $response = $client->request('POST', env('MAMOPAY_URL') . '/accounts/recipients', [
                        'json' => [
                            'recipient_type' => 'individual',
                            'relationship' => 'customer',
                            'bank' => [
                                'iban' => $param['iban'],                // IBAN from $param
                                'country' => 'AE', // Optional country, defaults to 'AE'
                                'account_number' => $param['account_number'],
                                'name' => $param['bank_name'],
                                'address' => $param['bank_address'],
                                'bic_code' => $param['bic_code'],
                            ],
                            'email' => $user->email,
                            'first_name' => $user->first_name,
                            'last_name' => $user->last_name,
                            'reason' => 'Payout for Seller',
                        ],
                        'headers' => [
                            'Authorization' => 'Bearer '.env('MAMOPAY_SECRET'),
                            'Accept' => 'application/json',
                            'Content-Type' => 'application/json',
                        ],
                    ]);

                    $rawData = json_decode($response->getBody(), true);  

                    $check->update([
                        'account_id' => $rawData['identifier'],
                        'iban' => $param['iban'],
                        'bic_code' => $param['bic_code'],
                        'account_fullname' => $param['account_fullname'],
                        'account_number' => $param['account_number'],
                        'bank_name' => $param['bank_name'],
                        'bank_address' => $param['bank_address']
                    ]);

                }else{
                    $response = $client->request('PATCH', env('MAMOPAY_URL') . '/accounts/recipients/'.$check->account_id, [
                        'json' => [
                            'recipient_type' => 'individual',
                            'relationship' => 'customer',
                            'bank' => [
                                'iban' => $param['iban'], 
                                'country' => 'AE', // default for UAE only
                                'account_number' => $param['account_number'],
                                'name' => $param['bank_name'],
                                'address' => $param['bank_address'],
                                'bic_code' => $param['bic_code'],
                            ],
                            'email' => $user->email,
                            'first_name' => $user->first_name,
                            'last_name' => $user->last_name,
                            'reason' => 'Payout for Seller',
                        ],
                        'headers' => [
                            'Authorization' => 'Bearer '.env('MAMOPAY_SECRET'),
                            'Accept' => 'application/json',
                            'Content-Type' => 'application/json',
                        ],
                    ]);

                    $check->update([
                        'iban' => $param['iban'],
                        'bic_code' => $param['bic_code'],
                        'account_fullname' => $param['account_fullname'],
                        'account_number' => $param['account_number'],
                        'bank_name' => $param['bank_name'],
                        'bank_address' => $param['bank_address']
                    ]);

                }

            }

            $data = json_decode($response->getBody(), true);

            return response([
                'data' => $data,
                'message' => 'User Bank Successfully Updated.', 
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

            if ($item->status == Item::STATUS_BID_ACCEPTED) {
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
                            'unit_amount' => $total,
                        ],
                        'quantity' => 1, // static for now
                    ],
                ],
                'payment_intent_data' => [
                    'application_fee_amount' => $fees,
                    'transfer_data' => ['destination' => $stripe_id],
                ],
                'mode' => 'payment',
                'success_url' => 'http://localhost:5173/payment-success?session_id={CHECKOUT_SESSION_ID}&item=' . $item->uuid . '',
                'metadata' => [ // custom data
                    'uuid' => $item->uuid,
                    'user_id' => $user->id, // buyer
                    'percentage' => $item->total_fee_breakdown['platform_fee_percentage_value'],
                    'service_fee' => $fees,
                    'sub_total' => $total,
                    'total_amount' => $total,
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
                'status' => $check->status,
            ]);
            // return $data;

            $item->update([
                'status' => Item::STATUS_PROCESSING_PAYMENT,
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
                'subtotal_amount' => number_format(($payment->amount_received / 100), 2, '.', ' '),
                'total_amount' => number_format(($payment->amount_received / 100), 2, '.', ' '),
                'status' => 1, // paid (default)
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

    private function createVendorBank($request)
    {

        $response = $client->request('POST', env('MAMOPAY_URL') . '/accounts/recipients', [
            'body' => '{
            "recipient_type":"individual",
            "relationship":"customer",
            "bank":{
                "iban":"' . $request['iban'] . '",
                "country":"AE",
                "account_number":"' . $request['account_number'] . '",
                "name":"' . $request['bank_name'] . '",
                "address":"' . $request['bank_address'] . '",
                "bic_code":"' . $request['bic_code'] . '",
            },
            "email":"nabarro@gmail.com",
            "first_name":"ianxx",
            "last_name":"navxxs",
            "reason":"payout sample"
            }',
            'headers' => [
                'Authorization' => 'Bearer sk-7e181dd9-3324-4ddd-a6ef-d8d90b341324',
                'accept' => 'application/json',
                'content-type' => 'application/json',
            ],
        ]);

    }

}
