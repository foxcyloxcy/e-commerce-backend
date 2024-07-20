<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Item\StoreItemCommentRequest;
use App\Models\Item;
use App\Models\ItemComment;
use Illuminate\Support\Facades\DB;

class ItemCommentController extends Controller
{
    /**
     * Get list of cooments per item
     *
     * @param  mixed $request
     * @return void
     */
    protected function index(Request $request)
    {
        // for page size in pagination
        $size = $request->size ?: 10;

        try {
            $data = ItemComment::with('user')
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
    public function store(StoreItemCommentRequest $request) {

        $param = $request->validated();

        DB::beginTransaction();

        try {
            $bid = ItemComment::create($param);
            DB::commit();

            return response([
                'data' => $bid,
                'message' => 'Successfully Add New Comment.',
            ]);
        } catch (\Exception $e) {

            DB::rollBack();
            return response(['message' => $e->getMessage()], 400);
        }
    }
}
