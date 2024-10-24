<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use App\Models\Item;
use App\Models\ItemBidding;
use Illuminate\Http\Request;
use App\Http\Requests\Discount\CheckDiscountRequest;

class DiscountController extends Controller
{
    /**
     * Validate Discount
     */
    public function validateDiscount(CheckDiscountRequest $request)
    {
        $param = $request->validated();

        try {
            $item = Item::where('id', $param['item_id'])->first();

            // get discount if exist
            $discount = Discount::where('code', $param['discount'])->where('status', 0)->first();


            if ($item->status == Item::STATUS_BID_ACCEPTED) {
                $offer = ItemBidding::where('seller_id', $item->user_id)->where('item_id', $item->id)->where('buyer_id', auth('auth-api')->user()->id)->where('is_accepted', 1)->first();
                $price = $offer->asking_price;
            }else{
                $price = $item->price;
            }
            $service_discount_fee = ($price * $discount->discount_percentage) / 100;

            if(!empty($discount)){
                $data = [
                    "item" => $price,
                    "platform_fee" => number_format($service_discount_fee,2),
                    "platform_fee_percentage" => number_format($discount->discount_percentage).'%',
                    "platform_fee_percentage_value" => number_format($discount->discount_percentage),
                    "total" => $price + $service_discount_fee
                ];
                
            }else {
                return response(['message' => 'Invalid Promo Code!'], 401);
            }

            return response([
                'total_discount_breakdown' => $data,
                'message' => 'Discount successfully fetch.',
            ]);

        } catch (\Exception $e) {

            return response(['message' => $e->getMessage()], 400);
        }
    }
}
