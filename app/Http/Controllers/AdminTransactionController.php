<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;

class AdminTransactionController extends Controller
{
    /**
     * Get list of transaction
     *
     * @param  mixed $request
     * @return void
     */
    protected function index(Request $request)
    {
        $size = $request->size ?: 10;
        try {
            $data = Transaction::with('seller', 'buyer', 'transactionItem.item')->orderBy('id', 'desc')->paginate($size);

            return response(['data' =>  $data], 200);

        } catch (\Exception $e) {
            #error message
            return response(['message' => $e->getMessage()], 400);
        }
    }

    protected function show(Transaction $transaction)
    {
        $client = new \GuzzleHttp\Client();
        try {
            $has_discount = empty($transaction->discount_amount) ? 'No' : 'Yes';
            $platform_fee = 0;
            $platform_fee_percentage = 0;
            if($has_discount == 'Yes'){
                $platform_fee = $transaction->discount_amount;
                $platform_fee_percentage = $transaction->discount_amount_percentage;

            }
            // get payout
            $response = $client->request('GET', env('MAMOPAY_URL') .  '/disbursements/'.$transaction->payout_ref, [
                'headers' => [
                    'Authorization' => 'Bearer ' . env('MAMOPAY_SECRET'),
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ],
            ]);

            $payout = json_decode($response->getBody(), true);
                
            $data = [
                'transaction' => [
                    'transaction_number' => $transaction->transaction_number,
                    'payment_ref' => $transaction->payment_ref,
                    'item' => $transaction->transactionItem->item->item_name,
                    'buyer' => $transaction->buyer,
                    'seller' => $transaction->seller,
                    'payment_breakdown' => [
                        'item_price' => $payout['amount_formatted'],
                        'has_discount' => $has_discount,
                        'platform_fee_' => $platform_fee,
                        'platform_fee_percentage' => $platform_fee_percentage
                    ]
                ],
                'payout' => $payout

            ];

            return response(['data' => $data], 200);

        } catch (\Exception $e) {
            #error message
            return response(['message' => $e->getMessage()], 400);
        }

    }
}
