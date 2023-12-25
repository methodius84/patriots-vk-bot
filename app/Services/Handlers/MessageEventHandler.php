<?php

namespace App\Services\Handlers;

use App\DTO\VkCallbackDto\MessageEventDto;
use App\Services\Actions\Message;

class MessageEventHandler extends VkCallbackHandlerAbstract
{
    private const BACKWARDS = 'backwards';

    public function handle()
    {
        // TODO: Implement handle() method.
        /** @var MessageEventDto $event */
        $event = $this->dto->getObject();
        $payload = $event->getPayload();
        if (!$payload) {
            // TODO: message with error + logging
        }
        switch ($event->getPayload()['command']) {
            case static::BACKWARDS:
                $this->backwards($event, $payload['menu_state']);
                break;
        }

        // after event handle we need to answer
        $this->answer($event);
        return 'ok';
    }

    private function answer(MessageEventDto $messageEvent): void
    {
        $params = [];
        $params['event_id'] = $messageEvent->getEventId();
        $params['user_id'] = $messageEvent->getUserId();
        $params['peer_id'] = $messageEvent->getPeerId();
        $params['event_data'] = '';
        (new Message($this->app))->sendMessageEventAnswer($params);
    }

    private function backwards(MessageEventDto $message, string $menuState): void
    {
        $params = [];
        $params['peer_id'] = $message->getUserId();
        $params['random_id'] = 0;
        if(!in_array($menuState, static::MENU_STATES)) {
            //TODO throw new Error
        }
        $params['keyboard'] = match ($menuState) {
            'info' => $this->encodedKeyboard('main_menu'),
            'some' => $this->encodedKeyboard('some'),
            default => $this->encodedKeyboard('main_menu'),
        };
        $params['message'] = 'Назад';
        (new Message($this->app))->sendMessage($params);
    }
}
