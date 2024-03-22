<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\ApiResponse\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    use ApiResponse;

    /**
     * Get list User
     *
     * @return void
     */
    public function register(RegisterRequest $request)
    {
        try {
            $email = $request->email;
            $input = $request->all();
            $input['password'] = bcrypt($input['password']);
            $user = User::create($input);
            $success['token'] =  $user->createToken('token')->accessToken;

            return $this->successResponse('Register successful', ['user' => $user]);
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }
    }

    public function login(LoginRequest $request)
    {
        try {
            $credentials = $request->only(['email', 'password']);
            if ($credentials) {
                if (Auth::attempt($credentials)) {
                    $user = Auth::user();
                    $user = $request->user();
                    $success = $user->createToken('authToken')->accessToken;

                    return $this->successResponse('Login successful', ['token' => $success, 'user' => $user]);
                } else {
                    return $this->errorResponse('Unauthorised', 401);
                }
            } else {
                return $this->errorResponse('Unauthorised', 401);
            }
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }
    }

    public function logout(Request $request)
    {
        try {
            if ($request->user()) {
                $request->user()->tokens()->delete();
            }
            return $this->successResponse('You are logout');
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }
    }
}
