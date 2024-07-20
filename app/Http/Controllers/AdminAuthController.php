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
}
