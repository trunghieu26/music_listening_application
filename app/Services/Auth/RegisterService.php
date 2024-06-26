<?php

namespace App\Services\Auth;

use App\ApiResponse\ApiResponse;
use App\Repositories\UserRepository;
use App\Services\BaseService;
use Illuminate\Support\Facades\Hash;
use Throwable;

class RegisterService extends BaseService
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
            $object_user = $this->repository->create([
                'name' => $data['name'],
                'email' => $data['email'],
                'gender' => $data['gender'],
                'password' => Hash::make($data['password'])
            ]);
            return $object_user; 
        } catch (Throwable $e) {
            return $e;
        }
    }
}