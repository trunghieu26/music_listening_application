<?php

namespace App\Services\Api\Auth;

use App\ApiResponse\ApiResponse;
use App\Repositories\UserRepository;
use App\Services\BaseService;

class RegisterService extends BaseService
{
    use ApiResponse;

    public function __construct(UserRepository $userRepository)
    {
        $this->repository = $userRepository;
    }


    public function handle()
    {
        $user = $this->credential();
        // check auth
        if (empty($user)) {
            return $this->errorResponse(__('User does not exist!'));
        }
        $token = $this->getToken($user);

        return $this->successResponse('', $token);
    }

    /**
     * Credential Information
     *
     * @return mixed
     */
    protected function credential()
    {
        $user = $this->repository->getUserLogin($this->data);
        
        return $user;
    }

    /**
     * Get Token
     *
     * @param User $user
     * @return array
     */
    protected function getToken($user): array
    {
        $token = $user->createToken('php-laravel-testing');

        return [
            'token_type'   => 'Bearer',
            'access_token' => $token->accessToken,
            'expired_at'   => $token->token->expires_at,
        ];
    }

}