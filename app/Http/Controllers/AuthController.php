<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\LoginRequest;
use App\Http\Requests\User\RegistrationRequest;
use App\Http\Requests\User\VerifyUserRequest;
use App\Http\Requests\User\ChangePasswordRequest;
use App\Http\Requests\User\ForgotPasswordRequest;
use App\Http\Requests\User\SetNewPasswordRequest;
use App\Http\Requests\User\ResendVerificationCodeRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Notifications\TestEmailNotification;
use Illuminate\Support\Facades\Mail;
use App\Models\VerificationCode;
use Carbon\Carbon;
use App\Notifications\UserVerificationNotification;

class AuthController extends Controller
{
    /**
     * Login
     *
     * @param  mixed $request
     * @return \Illuminate\Http\Response
     */
    public function login(LoginRequest $request) {

        $param = $request->validated();

        $field = 'email';
        if (is_numeric($param['username'])) {
            $field = 'mobile_number';
        } else {
            $field = 'email';
        }

        $request->merge([$field => $param['username']]);

        try {
            $credentials = $request->only($field, 'password');
            $credentials['status'] = 1;

            // validate credentials
            if (Auth::attempt($credentials, true)) {

                //user data
                $user = User::where('email', $param['username'])->orWhere('mobile_number', $param['username'])->first();
                if (!$user->email_verified_at) {
                    //add verification code to user
                    $code = rand(100000, 999999); // 6 digits
                    VerificationCode::create([
                        'user_id' => $user->id,
                        'code' => $code,
                        'expired_at' => Carbon::now()->addMinutes(5),
                    ]);

                    $user->notify(new UserVerificationNotification($code));

                    return response(['message' => 'Please Verify your Account', 'data' => ['user' => $user, 'redirect' => 'verify']], 200);

                }
                // generate the access token with the correct scope
                $tokenResult = $user->createToken('User Access Token', ['auth-api']);

                return response(['message' => 'Sign In Successful', 'data' => ['access_token' => $tokenResult->accessToken, 'user' => $user, 'redirect' => 'dashboard']], 200);
            } else {
                return response(['message' => array(['password' => 'Invalid Account Credentials.'])], 400);
            }
        } catch (\Exception $e) {
            return response(['message' => $e->getMessage()], 400);
        }
    }

    /**
     * signUp
     *
     * @param  mixed $request
     * @return void
     */
    public function signUp(RegistrationRequest $request) {

        DB::beginTransaction();

        try {

            $param = $request->validated();
            $user = User::create($param);
            $user->password = Hash::make($param['password']);
            $user->save();

            $getVendor = Vendor::where('user_id', $user->id)->first();

            if(!empty($getVendor)){
                $getVendor->update([
                    'name' => $user->first_name.' '.$user->last_name
                ]);
            }else{
                Vendor::create([
                    'user_id' => $user->id,
                    'name' => $user->first_name.' '.$user->last_name
                ]);
            }

            //add verification code to user
            $code = rand(100000, 999999); // 6 digits
            VerificationCode::create([
                'user_id' => $user->id,
                'code' => $code,
                'expired_at' => Carbon::now()->addMinutes(5),
            ]);

            DB::commit();

            // notify user            
            $user->notify(new UserVerificationNotification($code));

            return response([
                'data' => $user,
                'message' => 'Successfully Registered',
            ]);
        } catch (\Exception $e) {

            DB::rollBack();
            return response(['message' => $e->getMessage()], 400);
        }
    }

    /**
     * verifyUser
     *
     * @param  mixed $request
     * @return void
     */
    public function verifyUser(VerifyUserRequest $request)
    {
        DB::beginTransaction();

        try {
            //get user by email address
            $user = User::where('email', $request->email)->first();

            //get the verification code row
            $code = VerificationCode::where('code', $request->code)
                ->where('user_id', $user->id)
                ->where('is_success', VerificationCode::NOT_SUCCESS)
                ->first();

            //check if the code and email is valid
            if (!$code) {
                return response([
                    'message' => ['code' => 'Invalid verification code.'],
                ], 400);
            }

            //check if the code is expired
            if ($code->expired_at < Carbon::now()) {
                return response(['message' => array(['code' => 'Verification code is expired. Click resend code to request a new code.'])], 400);
            } else {
                //update the online user
                $user->email_verified_at = Carbon::now();
                $user->save();

                //update the verification code
                $code->is_success = VerificationCode::IS_SUCCESS;
                $code->save();

                // generate the access token with the correct scope
                $tokenResult = $user->createToken('User Access Token', ['auth-api']);

                DB::commit();

                $type = "";
                if($request->type == 'forgot password'){
                    $type= "forgot password";
                }

                return response(['message' => 'Verification Successful', 'data' => ['access_token' => $tokenResult->accessToken, 'user' => $user], 'type' => $type], 200);

            }
        } catch (\Exception $e) {
            DB::rollBack();
            return response(['message' => $e->getMessage()], 400);
        }
    
    }

    public function testEmail(Request $request) {
        $user = User::where('id', 1)->first();
        $user->notify(new TestEmailNotification());
        return 'success';
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
            $user = User::find(auth()->user()->id);
            
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

    /**
     * Forgot Password
     *
     * @param  mixed $request
     * @param  mixed $user
     * @return void
     */
    public function forgotPassword(ForgotPasswordRequest $request)
    {
         #Validate
         $form = $request->validated();

         DB::beginTransaction();
 
         try {
            $user = User::where('email', $form['email'])->first();

            //add verification code to user
            $code = rand(100000, 999999); // 6 digits
            VerificationCode::create([
                'user_id' => $user->id,
                'code' => $code,
                'expired_at' => Carbon::now()->addMinutes(5),
            ]);

            DB::commit();

            // notify user            
            $user->notify(new UserVerificationNotification($code));
            
            return response(['message' =>  "OTP has been already Sent"], 200);
         } catch (\Exception $e) {
             //Rollback Changes
             DB::rollback();
 
             return response(['message' => $e->getMessage()], 400);
        }
    }

    /**
     * Set New Password
     *
     * @param  mixed $request
     * @param  mixed $user
     * @return void
     */
    public function setNewPassword(SetNewPasswordRequest $request)
    {
         #Validate
         $form = $request->validated();

         DB::beginTransaction();
 
         try {
            $user = User::where('uuid', $form['uuid'])->first();

            // check if password is same with current password
            if ($user) {
                $user->password = Hash::make($form['password']);
                $user->update();
                DB::commit();
                return response(['data' =>  $user, 'message' => 'Password was successfully changed.'], 200);
            }

            return response(['message' =>  "Something went wrong!"], 400);
         } catch (\Exception $e) {
             //Rollback Changes
             DB::rollback();
 
             return response(['message' => $e->getMessage()], 400);
        }
    }

    public function resendVerificationCode(ResendVerificationCodeRequest $request)
    {
         #Validate
         $form = $request->validated();

         DB::beginTransaction();
 
         try {
            //get user by email address
            $user = User::where('email', $form['email'])->first();

            if(!empty($user)){
                //update active code to this user to inactive
                $updateAll = VerificationCode::where('is_success', 0)->where('user_id', $user->id)->update(['is_success' => 1]);

                //send new code
                $code = rand(100000, 999999); // 6 digits
                VerificationCode::create([
                    'user_id' => $user->id,
                    'code' => $code,
                    'expired_at' => Carbon::now()->addMinutes(5),
                ]);

                DB::commit();

                // notify user            
                $user->notify(new UserVerificationNotification($code));

                return response(['message' =>  "Code successfully resend"], 200);

            }

            return response(['message' =>  "Something went wrong!"], 400);
         } catch (\Exception $e) {
             //Rollback Changes
             DB::rollback();
 
             return response(['message' => $e->getMessage()], 400);
        }
    }
}
