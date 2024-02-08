<?php

namespace App\Http\Controllers;

use Crm\User\Requests\UserCreation;
use Crm\User\Services\UserService;

class UserController
{
    private UserService $userService;
    const TOKEN_NAME = "personal";
    public function __construct(UserService $userService)
    {
        $this->setUserService($userService);
    }

    public function create(UserCreation $request) {
        $user = $this->userService->create($request);
        return response()->json(
            [
                'user' => $user,
                'token' => $user->createToken(self::TOKEN_NAME)->plainTextToken
            ]
        );
    }
    /**
     * @return UserService
     */
    public function getUserService(): UserService
    {
        return $this->userService;
    }
    /**
     * @param UserService $userService
     */
    public function setUserService(UserService $userService): void
    {
        $this->userService = $userService;
    }

}
