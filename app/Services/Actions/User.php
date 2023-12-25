<?php

namespace App\Services\Actions;

use App\DTO\VkApiDto\User\UserDto;
use App\Services\VkApp;

class User implements ActionInterface
{
    public function __construct(private readonly VkApp $app){}

    public function getUser(string $userId): UserDto
    {
        $params = [
            'user_id' => $userId
        ];
        $response = $this->app->send('users.get', $params);
        if ($response)
        return UserDto::createFromResponse(array_pop($response));
    }
}
