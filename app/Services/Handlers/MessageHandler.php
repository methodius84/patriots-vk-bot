<?php

namespace App\Services\Handlers;

use App\DTO\VkCallbackDto\NewMessageDto;
use App\Services\Actions\Message;
use App\Services\Actions\User;
use Illuminate\Support\Facades\Log;

class MessageHandler extends VkCallbackHandlerAbstract
{
    public function handle(): string
    {
        /** @var NewMessageDto $object */
        $object = $this->dto->getObject();
        $message = $object->getMessage();
        if ($message->getPayload()) {
            $payload = $message->getPayload();
            $user = (new User($this->app))->getUser($message->getFromId());
            if ($payload['command'] === 'start') {
                $params = [];
                $params['peer_id'] = $user->getId();
                $params['random_id'] = 0;
                $params['message'] = 'Привет, ' . $user->getFirstName();

                (new Message($this->app))->sendMessage($params);

                $params['message'] = 'Смотри, что я умею!';
                // main menu
                $params['keyboard'] = json_encode(config('menu.main_menu'));
                $result = (new Message($this->app))->sendMessage($params);
                return 'ok';
            } elseif ($payload['command'] === 'application') {
                $params = [];
                $params['peer_id'] = $user->getId();
                $params['random_id'] = 0;
                $firstName = $user->getFirstName();
                $params['message'] = <<<EOT
$firstName, заявку можно оставить по ссылке: https://forms.gle/QwtaDYnpTFbdxs1V6

Ждем твою заявку!
EOT;
                $result = (new Message($this->app))->sendMessage($params);
                return 'ok';
            } elseif ($payload['command'] === 'about') {
                $params = [];
                $params['peer_id'] = $user->getId();
                $params['random_id'] = 0;
                $firstName = $user->getFirstName();
                $params['message'] = <<<EOT
$firstName, клуб Московские Патриоты - 14 кратный чемпион России по американскому футболу.
Команда существует с 3 октября 2001 года.
EOT;
                (new Message($this->app))->sendMessage($params);
                return 'ok';
            }
        }
        $params = [];
        $params['peer_id'] = $message->getFromId();
        $params['random_id'] = 0;
        $params['message'] = $message->getText();
        $result = (new Message($this->app))->sendMessage($params);
        return 'ok';
    }
}
