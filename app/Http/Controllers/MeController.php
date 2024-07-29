<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Vendor;
use App\Models\Item;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\User\UpdateUserDetailsRequest;
use App\Http\Requests\User\UpdateUserVendorDetailsRequest;

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
}
