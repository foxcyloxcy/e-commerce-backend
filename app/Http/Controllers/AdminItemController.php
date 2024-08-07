<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Item\StoreItemRequest;
use App\Http\Requests\Item\UpdateItemStatusRequest;
use App\Models\Item;
use App\Models\ItemProperty;
use App\Models\SubCategoryProperty;
use App\Models\SubCategoryPropertyValue;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\Item\ItemResource;
use App\Notifications\ItemApproveNotification;
use App\Notifications\ItemDeclineNotification;

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
     * Patch Item Status Approved by uuid
     *
     * @param  mixed $request
     * @param  mixed $items
     * @return void
     */
    protected function approveItem(Item $item)
    {
        DB::beginTransaction();
        try {
            $item->update(['status' => Item::STATUS_PUBLISHED]);
            DB::commit();

            // notification here
            $item->user->notify(new ItemApproveNotification());

            return response(['data' =>  $item, 'message' => 'Item status successfully approved.'], 200);
        } catch (\Exception $e) {
            //Rollback Changes
            DB::rollback();
            return response(['message' => $e->getMessage()], 400);
        }
    }

    protected function declineItem(Request $request, Item $item)
    {

        DB::beginTransaction();
        try {
            $item->update(['status' => Item::STATUS_REJECTED, 'reject_reason' => $request->reason]);
            DB::commit();

            // notification here
            $item->user->notify(new ItemDeclineNotification($request));

            return response(['data' =>  $item, 'message' => 'Item status successfully declined.'], 200);
        } catch (\Exception $e) {
            //Rollback Changes
            DB::rollback();
            return response(['message' => $e->getMessage()], 400);
        }
    }

    protected function pending(Request $request)
    {
        // for page size in pagination
        $size = $request->size ?: 10;
        try {
            $data = Item::where('status', 0)->orderBy('id', 'asc')->paginate($size);
            return response(['data' =>  $data], 200);
        } catch (\Exception $e) {
            #error message
            return response(['message' => $e->getMessage()], 400);
        }
    }

    protected function show(Item $item)
    {
        try {
            $subCategory = SubCategoryProperty::where('sub_category_id', $item->sub_category_id)->get();

            $data = $subCategory->map(function ($props) use ($item) {
                return  [
                    'properties' => $props->name,
                    'values' => SubCategoryPropertyValue::where('sub_category_property_id', $props->id)->whereIn('id', $item->itemProperty->pluck('sub_property_value_id'))->get()
                ];
            });

            return response(['item_details' => new ItemResource($item), 'item_property_details' => $data], 200);

        } catch (\Exception $e) {
            #error message
            return response(['message' => $e->getMessage()], 400);
        }

    }
}
