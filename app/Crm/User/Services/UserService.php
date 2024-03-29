<?php

namespace Crm\User\Services;

use Crm\User\Requests\UserCreation;
use Crm\User\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function create(UserCreation $request): ?User
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        event(new \Crm\User\Events\UserCreation($user));
        return $user;
    }
}
