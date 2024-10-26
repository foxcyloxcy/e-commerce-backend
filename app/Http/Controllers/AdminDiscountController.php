<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Discount;
use App\Models\DiscountCode;
use App\Http\Requests\Admin\StoreDiscountRequest;
use Illuminate\Support\Facades\DB;

class AdminDiscountController extends Controller
{
    /**
     * Get list of discounts
     *
     * @param  mixed $request
     * @return void
     */
    protected function index(Request $request)
    {
        // for page size in pagination
        $size = $request->size ?: 10;
        try {
            $data = DiscountCode::orderBy('id', 'desc')->paginate($size);
            return response(['data' =>  $data], 200);
        } catch (\Exception $e) {
            #error message
            return response(['message' => $e->getMessage()], 400);
        }
    }

     /**
     * create discount codes
     *
     * @param  mixed $request
     * @return void
     */
    protected function store(StoreDiscountRequest $request)
    {
        $param = $request->validated();

        DB::beginTransaction();

        try {
            $data = DiscountCode::create($param);
            DB::commit();


            return response([
                'data' => $data,
                'message' => 'Discount Code has been added.',
            ]);
        } catch (\Exception $e) {

            DB::rollBack();
            return response(['message' => $e->getMessage()], 400);
        }
    }

    protected function updateStatus(Request $request, DiscountCode $discount)
    {
        DB::beginTransaction();
        try {
            $discount->update(['status' => $request->status]);
            DB::commit();
            if($request->status == 1){
                return response(['data' =>  $discount, 'message' => 'Discount code is enabled.'], 200);
            }else{
                return response(['data' =>  $discount, 'message' => 'Discount code is disabled.'], 200);
            }
            
        } catch (\Exception $e) {
            //Rollback Changes
            DB::rollback();
            return response(['message' => $e->getMessage()], 400);
        }
    }
}
