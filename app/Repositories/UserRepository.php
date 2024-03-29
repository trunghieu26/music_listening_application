<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Hash;

class UserRepository extends BaseRepository
{
    /**
     * Get the model of User
     *
     * @return string
     */
    public function getModel()
    {
        return User::class;
    } 

}