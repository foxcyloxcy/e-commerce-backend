<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Transaction\StoreTransactionRequest;
use App\Models\Transaction;
use App\Models\TransactionItem;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    /**
     * Get list of Category
     *
     * @param  mixed $request
     * @return void
     */
    protected function index(Request $request)
    {

        try {
            $data = Transaction::with('transactionItem', 'transactionItem.item')->where('seller_id', $request->seller_id)->get();

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
    public function store(StoreTransactionRequest $request) {

        $param = $request->validated();

        DB::beginTransaction();

        try {
            $param['transaction_number'] = uniqid();

            $items = $param['items'];

            unset($param['items']);

            $data = Transaction::create($param);

            foreach ($items as $item) {
                TransactionItem::create([
                    'transaction_id' => $data->id,
                    'item_id' => $item['item_id']
                ]);
            }

            DB::commit();

            return response([
                'data' => $item,
                'message' => 'Successfully Added! Please wait for the item confirmation of admin.',
            ]);
        } catch (\Exception $e) {

            DB::rollBack();
            return response(['message' => $e->getMessage()], 400);
        }
    }
}
