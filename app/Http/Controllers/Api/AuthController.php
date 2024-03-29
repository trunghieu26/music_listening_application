<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\ApiResponse\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;

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

    public function sendResetLinkEmail(Request $request)
    {
        try {
            $user = User::where('email', $request->email)->first();

            if (!$user) {
                return $this->errorResponse('User with this email address does not exist', 404);
            }

            $response = Password::sendResetLink(
                ['email' => $request->email]
            );

            if ($response === Password::RESET_LINK_SENT) {
                return $this->successResponse('Reset password link sent to your email');
            } else {
                return $this->errorResponse('Unable to send reset password link', 500);
            }
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }
    }

    public function reset()
    {
        try {
            $credentials = request()->validate([
                'email' => 'required|email',
                'token' => 'required|string',
                'password' => 'required|string|confirmed'
            ]);

            $reset_password_status = Password::reset($credentials, function ($seeker, $password) {
                $seeker->password = bcrypt($password);
                $seeker->setRememberToken(Str::random(60));
                $seeker->save();
            });

            if ($reset_password_status == Password::INVALID_TOKEN) {
                return view('auth.reset_password_fail');
            }
            return view('auth.reset_password_success');
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }
    }

    public function changePassword(Request $request)
    {
        $input = $request->all();
        $userid = Auth::guard('api')->user()->id;
        $rules = array(
            'old_password' => 'required',
            'new_password' => 'required|min:6',
            'confirm_password' => 'required|same:new_password',
        );

        $validator = Validator::make($input, $rules);
        if ($validator->fails()) {
            $arr = array("status" => 400, "message" => $validator->errors()->first(), "data" => array());
        } else {
            try {
                if ((Hash::check(request('old_password'), Auth::user()->password)) == false) {
                    $arr = array("status" => 400, "message" => "Check your old password.", "data" => array());
                } else if ((Hash::check(request('new_password'), Auth::user()->password)) == true) {
                    $arr = array("status" => 400, "message" => "Please enter a password which is not similar then current password.", "data" => array());
                } else {
                    User::where('id', $userid)->update(['password' => Hash::make($input['new_password'])]);
                    $arr = array("status" => 200, "message" => "Password updated successfully.", "data" => array());
                }
            } catch (\Exception $ex) {
                $msg = $ex->getMessage();
                $arr = array("status" => 400, "message" => $msg, "data" => array());
            }
        }
        return response()->json($arr);
    }
}
