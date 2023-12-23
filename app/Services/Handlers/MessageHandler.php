<?php

namespace App\Services;

use App\DTO\VkCallbackDto\VkNewEventDto;
use App\Services\Handlers\VkCallbackHandlerAbstract;
use App\Services\Handlers\VkCallbackHandlerInterface;

class MessageHandler extends VkCallbackHandlerAbstract
{
    public function handle(): string
    {
        if ($this->dto->getObject()) {
            $payload = json_decode($this->dto->getObject()->getPayload());
            if ($payload->command === 'start') {
                $params = [];
                $params['user_id'] = $this->data['peer_id'];
                $user = $this->app->getUser($this->data['peer_id']);

                $result = $this->app->send('messages.send', $params);
            }
        }
        return 'ok';
    }
}
