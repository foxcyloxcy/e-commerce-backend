<?php

namespace App\Http\Controllers;

use App\Http\Requests\Bank\StoreUserBankRequest;
use App\Models\Item;
use App\Models\ItemBidding;
use App\Models\TempTransaction;
use App\Models\Transaction;
use App\Models\Discount;
use App\Models\TransactionItem;
use App\Models\VendorBank;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\StripeClient;

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
                            'iban' => $param['iban'], // IBAN from $param
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
                        'Authorization' => 'Bearer ' . env('MAMOPAY_SECRET'),
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
                    'bank_address' => $param['bank_address'],
                ]);

            } else {

                if (empty($check->account_id)) {
                    $response = $client->request('POST', env('MAMOPAY_URL') . '/accounts/recipients', [
                        'json' => [
                            'recipient_type' => 'individual',
                            'relationship' => 'customer',
                            'bank' => [
                                'iban' => $param['iban'], // IBAN from $param
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
                            'Authorization' => 'Bearer ' . env('MAMOPAY_SECRET'),
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
                        'bank_address' => $param['bank_address'],
                    ]);

                } else {
                    $response = $client->request('PATCH', env('MAMOPAY_URL') . '/accounts/recipients/' . $check->account_id, [
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
                            'Authorization' => 'Bearer ' . env('MAMOPAY_SECRET'),
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
                        'bank_address' => $param['bank_address'],
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

    public function checkout(Request $request,Item $item)
    {
        $user = auth('auth-api')->user();
        try {
            $client = new \GuzzleHttp\Client();

            if(($item->status != Item::STATUS_PUBLISHED) && ($item->status != Item::STATUS_BID_ACCEPTED)){
                return response(['message' => 'Please try again!'], 401);
            }

            if(!empty($request->discount)){
                //check discount if exist
                $discount = Discount::where('code', $request->discount)->where('status', 0)->first();
                if(!empty($discount)){ // if valid
                    
                    if ($item->status == Item::STATUS_BID_ACCEPTED) {
                        $offer = ItemBidding::where('seller_id', $item->user_id)->where('item_id', $item->id)->where('buyer_id', auth('auth-api')->user()->id)->where('is_accepted', 1)->first();
                        $asking_price = $offer->asking_price ;
                        $discount_percentage = $discount->discount_percentage;
                        $fees = ($asking_price * $discount->discount_percentage) / 100;
                        $total = $asking_price + $fees;
                        $payout_share = round(($offer->asking_price / $total) * 100);

                    }else{
                        $discount_percentage = $discount->discount_percentage;
                        $fees = ($item->price * $discount->discount_percentage) / 100;
                        $total = $item->price + $fees;
                        $payout_share = round(($item->price / $total) * 100);
                        
                    }

                    
                }else {
                    return response(['message' => 'Invalid Promo Code!'], 401);
                }
            }else{
                
                if ($item->status == Item::STATUS_BID_ACCEPTED) {
                    $offer = ItemBidding::where('seller_id', $item->user_id)->where('item_id', $item->id)->where('buyer_id', auth('auth-api')->user()->id)->where('is_accepted', 1)->first();
                    
                    $discount_percentage = $item->total_fee_breakdown['platform_fee_percentage_value'];
                    $asking_price = $offer->asking_price ;
                    $fees = ($asking_price * $item->total_fee_breakdown['platform_fee_percentage_value']) / 100;
                    $total = $asking_price + $fees;
                    $payout_share = round(($asking_price / $total) * 100);

                }else{
                    $discount_percentage = $item->total_fee_breakdown['platform_fee_percentage_value'];
                    $fees = ($item->price * $item->total_fee_breakdown['platform_fee_percentage_value']) / 100;
                    $total = $item->total_fee_breakdown['total'];
                    $payout_share = round(($item->price / $total) * 100);
                    
                }     

            }


            $response = $client->request('POST', env('MAMOPAY_URL') . '/links', [
                'json' => [
                    'title' => $item->item_name,
                    'description' => $item->item_description,
                    'capacity' => 1,
                    'active' => true,
                    'return_url' => 'http://localhost:5173/payment-success',
                    'failure_return_url' => 'http://localhost:5173/payment-failed',
                    'processing_fee_percentage' => 0,
                    'amount' => $total,
                    'amount_currency' => 'AED',
                    'link_type' => 'standalone',
                    'enable_tabby' => false,
                    'enable_message' => false,
                    'enable_tips' => false,
                    'save_card' => 'off',
                    'enable_customer_details' => false,
                    'enable_quantity' => false,
                    'enable_qr_code' => false,
                    'send_customer_receipt' => false,
                    'hold_and_charge_later' => false,
                    'custom_data' => [
                        'uuid' => $item->uuid,
                        'user_id' => $user->id,
                        'seller_id' => $item->user_id,
                        'discount' => $request->discount, //discount code
                    ],
                    'payouts_share' => [
                        'recipient_id' => $item->user->vendorBank->account_id,
                        'percentage_to_recipient' => $payout_share,
                        'recipient_pays_fees' => false
                    ]
                ],
                'headers' => [
                    'Authorization' => 'Bearer ' . env('MAMOPAY_SECRET'),
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ],
            ]);
            $data = json_decode($response->getBody(), true);

            return response([
                'data' => $data,
                'message' => 'Checkout ready',
            ]);
        } catch (\Exception $e) {
            return response(['message' => $e->getMessage()], 400);
        }
       

    }


    /**
     * Save Successfull Transaction
     */
    public function saveSuccessTransaction(Request $request)
    {
        try {
            
            $client = new \GuzzleHttp\Client();
            
            $response = $client->request('GET', env('MAMOPAY_URL') . '/links/'.$request->transaction_number, [
                'headers' => [
                    'Authorization' => 'Bearer ' . env('MAMOPAY_SECRET'),
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ],
            ]);

            $data = json_decode($response->getBody(), true);

            
            $item = Item::where('uuid', $data['custom_data']['uuid'])->first();
            $item->update(['status' => Item::STATUS_SOLD]);

            // $data['custom_data']['discount_code']

            $discount_amount_percentage = 0;
            $discount_amount = 0;
            if(!empty($data['custom_data']['discount'])){
                $discount = Discount::where('code', $data['custom_data']['discount'])->where('status', 0)->first();
                if(!empty($discount)){
                    $discount_amount_percentage = $discount->discount_percentage;
                    
                    if($item->status == Item::STATUS_BID_ACCEPTED){
                        $offer = ItemBidding::where('seller_id', $item->user_id)->where('item_id', $item->id)->where('buyer_id', auth('auth-api')->user()->id)->where('is_accepted', 1)->first();
                        $discount_amount = ($offer->asking_price * $discount->discount_percentage) / 100;
                    }else{
                        $discount_amount = ($item->price * $discount->discount_percentage) / 100;
                    }

                    $discount->update([
                        'user_id' => $data['custom_data']['user_id'],
                        'status' => 1
                    ]);
                }
            }

            // return $data['amount'];
           

            $transaction = Transaction::create([
                'transaction_number' => $request->transaction_number,
                'payment_ref' => $request->payment_ref,
                'user_id' => $data['custom_data']['user_id'],
                'seller_id' => $data['custom_data']['seller_id'],
                'items_quantity' => 1,
                'service_fee_percentage' => $item->total_fee_breakdown['platform_fee_percentage_value'],
                'service_fee_amount' => $item->total_fee_breakdown['platform_fee'],
                'discount_amount_percentage' => $discount_amount_percentage,
                'discount_amount' => $discount_amount,
                'subtotal_amount' => $data['amount'],
                'total_amount' => $data['amount'],
                'status' => 1, // paid (default)
            ]);

            TransactionItem::create([
                'transaction_id' => $transaction->id,
                'item_id' => $item->id,
            ]);

            return response([
                'data' => $transaction,
                'message' => 'Successfully Paid.', // for indication only
            ]);

        } catch (\Exception $e) {
            return response(['message' => $e->getMessage()], 400);
        }
    }

    /**
     * Payout List
     */
    public function payoutsList(Request $request)
    {
        try {
            
            $client = new \GuzzleHttp\Client();


            $response = $client->request('GET', env('MAMOPAY_URL') .  '/disbursements', [
            'headers' => [
                'Authorization' => 'Bearer ' . env('MAMOPAY_SECRET'),
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ],
            ]);


            $data = json_decode($response->getBody(), true);

            return response(['data' => $data], 200);


        } catch (\Exception $e) {
            return response(['message' => $e->getMessage()], 400);
        }
    }

    public function payFeaturedProduct(Item $item)
    {
        $user = auth('auth-api')->user();
        try {
            $client = new \GuzzleHttp\Client();

            $response = $client->request('POST', env('MAMOPAY_URL') . '/links', [
                'json' => [
                    'title' => $item->item_name,
                    'description' => 'Featured Product Payment',
                    'capacity' => 1,
                    'active' => true,
                    'return_url' => 'http://localhost:5173/featured-payment-success',
                    'failure_return_url' => 'http://localhost:5173/featured-payment-failed',
                    'processing_fee_percentage' => 0,
                    'amount' => 100,
                    'amount_currency' => 'AED',
                    'link_type' => 'standalone',
                    'enable_tabby' => false,
                    'enable_message' => false,
                    'enable_tips' => false,
                    'save_card' => 'off',
                    'enable_customer_details' => false,
                    'enable_quantity' => false,
                    'enable_qr_code' => false,
                    'send_customer_receipt' => false,
                    'hold_and_charge_later' => false,
                    'custom_data' => [
                        'uuid' => $item->uuid,
                        'user_id' => $item->user_id
                    ]
                ],
                'headers' => [
                    'Authorization' => 'Bearer ' . env('MAMOPAY_SECRET'),
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ],
            ]);

            $data = json_decode($response->getBody(), true);

            return response([
                'data' => $data,
                'message' => 'Checkout ready',
            ]);

        } catch (\Exception $e) {

            return response(['message' => $e->getMessage()], 400);
        }
    }

      /**
     * Save Successfull Transaction (featured product)
     */
    public function saveFeaturedProductSuccessTransaction(Request $request)
    {
        try {

            $client = new \GuzzleHttp\Client();
            
            $response = $client->request('GET', env('MAMOPAY_URL') . '/links/'.$request->transaction_number, [
                'headers' => [
                    'Authorization' => 'Bearer ' . env('MAMOPAY_SECRET'),
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ],
            ]);

            $data = json_decode($response->getBody(), true);

            
            $item = Item::where('uuid', $data['custom_data']['uuid'])->first();
            
            $item->update(['is_featured' => 1]);
            
            return response([
                'data' => $data,
                'message' => 'Successfully Paid.', // for indication only
            ]);

        } catch (\Exception $e) {

            return response(['message' => $e->getMessage()], 400);
        }
    }

}
