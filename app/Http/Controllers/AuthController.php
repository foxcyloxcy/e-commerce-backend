<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\LoginRequest;
use App\Http\Requests\User\RegistrationRequest;
use App\Http\Requests\CreateUserRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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

                // generate the access token with the correct scope
                $tokenResult = $user->createToken('User Access Token', ['auth-api']);

                return response(['message' => 'Sign In Successful', 'data' => ['access_token' => $tokenResult->accessToken, 'user' => $user]], 200);
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

            DB::commit();

            return response([
                'data' => $user,
                'message' => 'Successfully Registered',
            ]);
        } catch (\Exception $e) {

            DB::rollBack();
            return response(['message' => $e->getMessage()], 400);
        }
    }
}
