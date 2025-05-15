<?php

namespace App\Services;

use App\Models\User;

class UserService
{
    public static function create(array $data): User
    {
        return User::updateOrCreate($data);
    }

    // public static function userLogin(array $data){

    // }


}
