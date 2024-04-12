<?php

namespace App\Services\Auth;

use App\ApiResponse\ApiResponse;
use App\Repositories\UserRepository;
use App\Services\BaseService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Throwable;

class LoginService extends BaseService
{
    use ApiResponse;

    public function __construct(UserRepository $userRepository)
    {
        $this->repository = $userRepository;
    }

    public function handle()
    {
        $data = $this->data;
        try {
            if(Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
                return true;
            } else {
                return false;
            }
        } catch (Throwable $e) {
            return $e;
        }
    }
}