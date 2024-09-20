<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Vendor;
use App\Models\VendorBank;
use App\Models\Item;
use App\Models\ItemBidding;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\User\UpdateUserDetailsRequest;
use App\Http\Requests\User\UpdateUserVendorDetailsRequest;
use App\Http\Requests\Bank\StoreUserBankRequest;
use App\Http\Requests\User\UploadUserPhotoRequest;
use App\Http\Requests\User\UploadVendorPhotoRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\Me\MyOfferResource;
use App\Http\Resources\Me\MyOfferCollection;
use Illuminate\Support\Arr;

class MeController extends Controller
{
    protected function profile(Request $request)
    {
        $data = auth()->user();
        try {
            return response(['data' =>  $data], 200);

        } catch (\Exception $e) {
            #error message
            return response(['message' => $e->getMessage()], 400);
        }
    }

    /**
     * Update Personal Info
     *
     * @param  mixed $request
     * @param  mixed $user
     * @return void
     */
    protected function updatePersonalInfo(UpdateUserDetailsRequest $request)
    {
        #Validate
        $param = $request->validated();
        $user = auth()->user();
        DB::beginTransaction();
        try {
            $user->update($param);
            DB::commit();
            return response(['data' =>  $user, 'message' => 'Successfully updated'], 200);
        } catch (\Exception $e) {
            //Rollback Changes
            DB::rollback();
            return response(['message' => $e->getMessage()], 400);
        }
    }

    /**
     * Create or Update Vendor Details
     *
     * @param  mixed $request
     * @param  mixed $user->vendor
     * @return void
     */
    protected function updateVendor(UpdateUserVendorDetailsRequest $request)
    {
        #Validate
        $param = $request->validated();
        $user = auth()->user();
        
        DB::beginTransaction();
        try {
            if($user->is_vendor == 'Yes'){
                $user->vendor->update($param);
            }else{
                // create new record
                Vendor::create([
                    'user_id' => $user->id,
                    'name' => $param['name'],
                    'address' => $param['address']
                ]);
            }
            DB::commit();
            return response(['data' =>  $user, 'message' => 'Successfully Updated'], 200);
        } catch (\Exception $e) {
            //Rollback Changes
            DB::rollback();
            return response(['message' => $e->getMessage()], 400);
        }
    }

    protected function items(Request $request)
    {
        $size = $request->size ?: 10;
        $data = Item::where('user_id', auth()->user()->id)->whereIn('status', explode(',',$request->status))->paginate($size);
        try {
            return response(['data' =>  $data], 200);

        } catch (\Exception $e) {
            #error message
            return response(['message' => $e->getMessage()], 400);
        }
    }

    /**
     * Add Bank Details Info
     *
     * @param  mixed $request
     * @param  mixed $user
     * @return void
     */
    protected function addUserBank(StoreUserBankRequest $request)
    {
        #Validate
        $param = $request->validated();

        DB::beginTransaction();
        try {
            $bank = VendorBank::create([
                'user_id' => $request->user_id,
                'bank_id' => $request->bank_id,
                'account_fullname' => $request->account_fullname,
                'account_number' => $request->account_number,
            ]);
            DB::commit();
            return response(['data' =>  $bank, 'message' => 'Successfully Added.'], 200);
        } catch (\Exception $e) {
            //Rollback Changes
            DB::rollback();
            return response(['message' => $e->getMessage()], 400);
        }
    }

    protected function userBankList(Request $request)
    {
        $data = VendorBank::with('bank')->where('user_id', auth()->user()->id)->get();
        try {
            return response(['data' =>  $data], 200);

        } catch (\Exception $e) {
            #error message
            return response(['message' => $e->getMessage()], 400);
        }
    }

    protected function uploadUserPhoto(UploadUserPhotoRequest $request)
    {
        #Validate
        $param = $request->validated();
        
        $user = auth()->user();

        DB::beginTransaction();
        try {
            $path = Storage::putFile('profiles', $request->file('photo'));
            // Get the URL
            $url = Storage::url($path);
            $user->update(['photo' => $url]);
            DB::commit();
            return response(['data' =>  $user, 'message' => 'Successfully Uploaded'], 200);
        } catch (\Exception $e) {
            //Rollback Changes
            DB::rollback();
            return response(['message' => $e->getMessage()], 400);
        }
    }

    protected function uploadVendorPhoto(UploadVendorPhotoRequest $request)
    {
        #Validate
        $param = $request->validated();
        
        $user = auth()->user();
        
        DB::beginTransaction();
        try {
            $path = Storage::putFile('profiles', $request->file('logo'));
            // Get the URL
            $url = Storage::url($path);
            $user->vendor->update(['logo' => $url]);
            DB::commit();
            return response(['data' =>  $user, 'message' => 'Successfully Uploaded'], 200);
        } catch (\Exception $e) {
            //Rollback Changes
            DB::rollback();
            return response(['message' => $e->getMessage()], 400);
        }
    }

    protected function myOffers(Request $request)
    {
        $size = $request->size ?: 10;
        
        $data = Item::with('user')->where('is_bid', 1)
            ->whereIn('status', [Item::STATUS_PUBLISHED, Item::STATUS_BID_ACCEPTED])
            ->whereHas('itemBidding', function ($q) use ($request) {
                $q->where('buyer_id', auth('auth-api')->user()->id);
            })->paginate($size);

        $pagination = $data->toArray();
        $pagination = $request->page != 'all' ? Arr::except($pagination, ['data']) : null;      
            
        try {
            return response(['data' => new MyOfferCollection($data), 'pagination' => $pagination ], 200);

        } catch (\Exception $e) {
            #error message
            return response(['message' => $e->getMessage()], 400);
        }
    }

    protected function offersToMe(Request $request)
    {
        $size = $request->size ?: 10;
        try {
            $data = Item::where('is_bid', 1)
            ->where('status', Item::STATUS_PUBLISHED)
            ->whereHas('itemBidding', function ($q) use ($request) {
                $q->where('seller_id', auth('auth-api')->user()->id)
                    ->where('is_accepted', 0);
            })->paginate($size);
            
            $pagination = $data->toArray();
            $pagination = $request->page != 'all' ? Arr::except($pagination, ['data']) : null;   
            return response(['data' => new MyOfferCollection($data), 'pagination' => $pagination ], 200);

        } catch (\Exception $e) {
            #error message
            return response(['message' => $e->getMessage()], 400);
        }
    }

    protected function offersToMeByUuid(Item $item)
    {
        try {
            $offers = ItemBidding::with('buyer','item')->where('seller_id', auth('auth-api')->user()->id)
            ->where('item_id', $item->id)
            ->where('is_accepted', 0)->get();    
            return response(['offers' => $offers], 200);

        } catch (\Exception $e) {
            #error message
            return response(['message' => $e->getMessage()], 400);
        }
    }

    protected function acceptOffer(ItemBidding $bid)
    {
        DB::beginTransaction();
        try {
            // return $bid;
            $bid->update(['is_accepted' => 1]);
            $bid->item->update(['status' => 4]);

            DB::commit();
            return response(['data' =>  $bid, 'message' => 'Successfully Accept Offer.'], 200);

        } catch (\Exception $e) {
            DB::rollback();
            #error message
            return response(['message' => $e->getMessage()], 400);
        }
    }

    protected function rejectOffer(ItemBidding $bid)
    {
        DB::beginTransaction();
        try {
            $bid->update(['is_accepted' => 2]);

            DB::commit();
            return response(['data' =>  $bid, 'message' => 'Successfully Reject Offer.'], 200);

        } catch (\Exception $e) {
            DB::rollback();
            #error message
            return response(['message' => $e->getMessage()], 400);
        }
    }
}
