<?php

namespace App\Services\Handlers;

use App\DTO\VkCallbackDto\NewMessageDto;

class MessageHandler extends VkCallbackHandlerAbstract
{
    public function handle(): string
    {
        /** @var NewMessageDto $object */
        $object = $this->dto->getObject();
        $message = $object->getMessage();
        if ($message->getPayload()) {
            $payload = json_decode($message->getPayload());
            if ($payload->command === 'start') {
                $params = [];
                $user = $this->app->getUser($message->getFromId());
                $params['peer_id'] = $user->getId();
                $params['random_id'] = 0;
                $params['message'] = 'Привет, ' . $user->getFirstName();

                $result = $this->app->send('messages.send', $params);
            }
        }
        return 'ok';
    }
}
