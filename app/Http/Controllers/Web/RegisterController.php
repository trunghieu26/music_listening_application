<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Services\Auth\RegisterService;
use App\Services\Auth\CheckUserExist;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index()
    {
        return view('register.index');
    }
    public function store(RegisterRequest $request)
    {
        $check_user_exist =  resolve(CheckUserExist::class)->CheckExist($request);
        if ($check_user_exist == 'true') {
            $create_user = resolve(RegisterService::class)->setData($request->validated())->handle();
            return redirect()->intended('login');
        } 
        return redirect()->intended('register');
    }
}
