<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LoginRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\AdminUser;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Admin\ChangePasswordRequest;

class AdminAuthController extends Controller
{
    /**
     * Login
     *
     * @param  mixed $request
     * @return \Illuminate\Http\Response
     */
    public function login(LoginRequest $request) {

        $param = $request->validated();

        try {

            $credentials = $request->only('email', 'password');

            // validate credentials
            if (Auth::guard('admin-web')->attempt($credentials, true)) {
                //user data
                $user = AdminUser::where('email', $param['email'])->first();

                // generate the access token with the correct scope
                $tokenResult = $user->createToken('Admin Access Token', ['auth-api-admin']);

                return response(['message' => 'Admin Sign In Successful', 'data' => ['access_token' => $tokenResult->accessToken, 'user' => $user]], 200);
            } else {
                return response(['message' => array(['password' => 'Invalid password.'])], 400);
            }
        } catch (\Exception $e) {
            return response(['message' => $e->getMessage()], 400);
        }
    }

    public function test(Request $request) {

        return auth('admin-api')->user();
    }

    /**
     * Update password
     *
     * @param  mixed $request
     * @param  mixed $user
     * @return void
     */
    public function changePassword(ChangePasswordRequest $request)
    {
         #Validate
         $form = $request->validated();

         DB::beginTransaction();
 
         try {
            $user = AdminUser::find(auth('admin-api')->user()->id);
    
            // check if password is same with current password
            if (Hash::check($form['current_password'], $user->password)) {
                $user->password = Hash::make($form['password']);
                $user->update();
                DB::commit();
                return response(['data' =>  $user, 'message' => 'Password was successfully updated.'], 200);
            }
 
            return response(['message' =>  ['current_password' => ['Invalid password.']]], 401);
         } catch (\Exception $e) {
             //Rollback Changes
             DB::rollback();
 
             return response(['message' => $e->getMessage()], 400);
        }
    }
}
