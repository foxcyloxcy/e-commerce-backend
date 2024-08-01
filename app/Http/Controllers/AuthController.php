<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\LoginRequest;
use App\Http\Requests\User\RegistrationRequest;
use App\Http\Requests\User\VerifyUserRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
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

                return response(['message' => 'Verification Successful', 'data' => ['access_token' => $tokenResult->accessToken, 'user' => $user]], 200);

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
}
