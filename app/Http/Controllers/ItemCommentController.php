<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Item\StoreItemCommentRequest;
use App\Models\Item;
use App\Models\User;
use App\Models\ItemComment;
use Illuminate\Support\Facades\DB;
use App\Notifications\NewCommentOwnerNotification;
use App\Notifications\NewCommentUserNotification;

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
            $comment = ItemComment::create($param);
            DB::commit();

            //notify owner of item if has more than 1 comment
            $checkComment = ItemComment::where('item_id', $comment->item_id)->count();

            if($checkComment == 1){
                // sent to seller
                $comment->item->user->notify(new NewCommentOwnerNotification($comment->item));
            }else{
                
                if($comment->user_id == $comment->item->user->id){ // send to buyers
  
                    $userList = ItemComment::where('item_id', $comment->item_id)->where('user_id', '!=',$comment->item->user->id)->get();

                    $uniqueIds = $userList->pluck('user_id')->unique();
                    // return $uniqueIds;
                    $identifier = 'Seller';
                    foreach ($uniqueIds as $ownerId) {
                        $user = User::find($ownerId);
                        if ($user) {
                            $user->notify(new NewCommentUserNotification($comment->item, $identifier));
                        }
                    }

                }else{ // send to seller and buyer
                    $userList = ItemComment::where('item_id', $comment->item_id)->where('user_id', '!=',$comment->user_id)->get();

                    $uniqueIds = $userList->pluck('user_id')->unique();
                    $identifier = 'Buyer';
                    foreach ($uniqueIds as $ownerId) {
                        $user = User::find($ownerId);
                        if ($user) {
                            $user->notify(new NewCommentUserNotification($comment->item, $identifier));
                        }
                    }
                    
                }
            }
            
            return response([
                'data' => $comment,
                'message' => 'Successfully Add New Comment.',
            ]);
        } catch (\Exception $e) {

            DB::rollBack();
            return response(['message' => $e->getMessage()], 400);
        }
    }
}
