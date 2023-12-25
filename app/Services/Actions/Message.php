<?php

namespace App\Services\Actions;

use App\DTO\VkApiDto\Message\SendMessageDto;
use App\Services\Actions\ActionInterface;
use App\Services\VkApp;
use Illuminate\Support\Facades\Log;

class Message implements ActionInterface
{

    public function __construct(private readonly VkApp $app){}

    public function sendMessage(array $params)
    {
        $response = $this->app->send('messages.send', $params);
        Log::channel('vk_log')->debug('debug send', [
            'response' => $response,
        ]);
        return SendMessageDto::createFromResponse($response);
    }
}
