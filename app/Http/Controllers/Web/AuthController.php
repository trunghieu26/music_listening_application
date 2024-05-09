<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Artist;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function forgotPassword() 
    {
        return view('login.forgotpassword');    
    }
}
