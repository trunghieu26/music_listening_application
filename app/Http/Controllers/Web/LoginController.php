<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Services\Auth\LoginService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('login.index');
    }

    public function login(Request $request)
    {
        $login_service = resolve(LoginService::class)->setData($request)->handle();
        if($login_service) {
            return redirect('/');
        } else {
            return redirect()->intended('login');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->back();
    }
}
