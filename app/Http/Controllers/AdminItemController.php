<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Item\StoreItemRequest;
use App\Http\Requests\Item\UpdateItemStatusRequest;
use App\Models\Item;
use App\Models\ItemProperty;
use Illuminate\Support\Facades\DB;

class AdminItemController extends Controller
{
    /**
     * Get list of items by status
     *
     * @param  mixed $request
     * @return void
     */
    protected function index(Request $request)
    {
        // for page size in pagination
        $size = $request->size ?: 10;
        try {
            $data = Item::where('status', $request->status)->orderBy('id', 'desc')->paginate($size);
            return response(['data' =>  $data], 200);
        } catch (\Exception $e) {
            #error message
            return response(['message' => $e->getMessage()], 400);
        }
    }

    /**
     * Patch Item Status by uuid
     *
     * @param  mixed $request
     * @param  mixed $items
     * @return void
     */
    protected function status(UpdateItemStatusRequest $request, Item $item)
    {
        #Validate
        $param = $request->validated();
        DB::beginTransaction();
        try {
            $item->update($param);
            DB::commit();

            // notification here


            return response(['data' =>  $item, 'message' => 'Item status successfully updated.'], 200);
        } catch (\Exception $e) {
            //Rollback Changes
            DB::rollback();
            return response(['message' => $e->getMessage()], 400);
        }
    }
}
