<?php

namespace App\Services\Auth;

use App\Models\User;
use Throwable;

class CheckUserExist {
    public function CheckExist($data)
    {
        try {
            $email = $data->email;

            $check_mail = User::where('email', $email)->first();
            //$checkUserExist = User::where('email', $email)->where('phone', $phone)->first();

            if($check_mail != null){
                return false;
            }
            return true;
        } catch (Throwable $e) {
            return ($e);
        }
    }
} 