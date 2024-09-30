<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Item\StoreItemBiddingRequest;
use App\Http\Requests\Item\UpdateStatusItemBiddingRequest;
use App\Models\Item;
use App\Models\ItemBidding;
use Illuminate\Support\Facades\DB;

class ItemBiddingController extends Controller
{
    /**
     * Get list of bidding per item and user
     *
     * @param  mixed $request
     * @return void
     */
    protected function index(Request $request)
    {
        // for page size in pagination
        $size = $request->size ?: 10;

        try {
            $data = ItemBidding::with('buyer')
                ->where('seller_id', $request->seller_id)
                ->where('item_id', $request->item_id)
                ->paginate($size);

            return response(['data' =>  $data], 200);

        } catch (\Exception $e) {
            #error message
            return response(['message' => $e->getMessage()], 400);
        }
    }

    /**
     * create new record
     *
     * @param  mixed $request
     * @return void
     */
    public function store(StoreItemBiddingRequest $request) {

        $param = $request->validated();

        DB::beginTransaction();

        try {
            $bid = ItemBidding::create($param);
            DB::commit();

            return response([
                'data' => $bid,
                'message' => 'Your offer has been received, we will notify you via email on the outcome once the seller has reviewed.',
            ]);
        } catch (\Exception $e) {

            DB::rollBack();
            return response(['message' => $e->getMessage()], 400);
        }
    }

    /**
     * Patch Bid Status
     *
     * @param  mixed $request
     * @param  mixed $items
     * @return void
     */
    protected function status(UpdateStatusItemBiddingRequest $request, ItemBidding $bid)
    {
        #Validate
        $param = $request->validated();
        DB::beginTransaction();
        try {
            $bid->update($param);

            if($request->is_accepted == 1){
                $bid->item->update(['status' => 4]);
            }
            DB::commit();

            // notification here

            return response(['data' =>  $bid, 'message' => 'Bidding status successfully updated.'], 200);
        } catch (\Exception $e) {
            //Rollback Changes
            DB::rollback();
            return response(['message' => $e->getMessage()], 400);
        }
    }
}
