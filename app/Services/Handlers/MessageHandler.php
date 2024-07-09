<?php

namespace App\Services\Handlers;

use App\DTO\VkApiDto\Message\SendMessageDto;
use App\DTO\VkApiDto\User\UserDto;
use App\DTO\VkCallbackDto\MessageDto;
use App\DTO\VkCallbackDto\NewMessageDto;
use App\Services\Actions\Message;
use App\Services\Actions\User;

class MessageHandler extends VkCallbackHandlerAbstract
{
    private const COMMAND_START = 'start';
    private const COMMAND_INFO = 'info';
    private const COMMAND_CLUB_INFO = 'club_info';
    private const COMMAND_TOURNAMENTS = 'current_tournaments';
    private const COMMAND_PARTNERSHIP = 'partnership';
    private const COMMAND_SPONSORSHIP = 'sponsorship';
    private const COMMAND_BARTER = 'barter';
    private const COMMAND_CONTACTS = 'contacts';
    private const COMMAND_CREATOR = 'creator';

    public function handle(): string
    {
        /** @var NewMessageDto $object */
        $object = $this->dto->getObject();
        $message = $object->getMessage();
        if ($message->getPayload()) {
            $payload = $message->getPayload();
            $user = (new User($this->app))->getUser($message->getFromId());
            switch ($payload['command']) {
                case static::COMMAND_START:
                    $this->start($user);
                    break;
                case static::COMMAND_INFO:
                    $this->info($message);
                    break;
                case static::COMMAND_CLUB_INFO:
                    $this->clubInfo($user);
                    break;
                case static::COMMAND_CONTACTS:
                    $this->contacts($message);
                    break;
                case static::COMMAND_TOURNAMENTS:
                    $this->tournaments($message);
                    break;
                case static::COMMAND_PARTNERSHIP:
                    $this->partnership($message, $user);
                    break;
                case static::COMMAND_SPONSORSHIP:
                    $this->sponsorship($message, $user);
                    break;
                case static::COMMAND_BARTER:
                    $this->barter($message, $user);
                    break;
                case static::COMMAND_CREATOR:
                    //TODO contact with creator
                    break;
            }
            if ($payload['command'] === 'application') {
                $params = [];
                $params['peer_id'] = $user->getId();
                $params['random_id'] = 0;
                $firstName = $user->getFirstName();
                $params['message'] = <<<EOT
$firstName, заявку можно оставить по ссылке: https://forms.gle/QwtaDYnpTFbdxs1V6

Ждем твою заявку!
EOT;
                $result = $this->sendAnswer($params);
                return 'ok';
            }
            return 'ok';
        } else {
            // todo: переделать в норм обработчик текста
            if ($message->getText() === 'Начать') {
                $params = [];
                $params['peer_id'] = $message->getFromId();
                $params['random_id'] = 0;
                $params['message'] = $message->getText();
                $params['keyboard'] = $this->encodedKeyboard('main_menu');
                $result = $this->sendAnswer($params);
            } else {
                $params = [];
                $params['peer_id'] = $message->getFromId();
                $params['random_id'] = 0;
                $params['message'] = $message->getText();
                $params['keyboard'] = $this->encodedKeyboard('main_menu');
                $result = $this->sendAnswer($params);
            }

            return 'ok';
        }
    }

    private function sendAnswer(array $params): SendMessageDto
    {
        return (new Message($this->app))->sendMessage($params);
    }

    private function start(UserDto $user): void
    {
        $params = [];
        $params['peer_id'] = $user->getId();
        $params['random_id'] = 0;
        $params['message'] = 'Привет, ' . $user->getFirstName();

        (new Message($this->app))->sendMessage($params);

        $params['message'] = 'Смотри, что я умею!';
        // main menu
        $params['keyboard'] = $this->encodedKeyboard('main_menu');
        $result = $this->sendAnswer($params);
    }

    private function info(MessageDto $message): void
    {
        $params = [];
        $params['peer_id'] = $message->getFromId();
        $params['random_id'] = 0;
        $params['message'] = static::MENU_MESSAGE_TEXT['info'];
        // about menu
        $params['keyboard'] = $this->encodedKeyboard('info');
        $result = $this->sendAnswer($params);
    }

    private function clubInfo(UserDto $user): void
    {
        $params = [];
        $params['peer_id'] = $user->getId();
        $params['random_id'] = 0;
        $firstName = $user->getFirstName();
        $params['message'] = <<<EOT
$firstName, клуб Московские Патриоты - 14 кратный чемпион России по американскому футболу.
Команда существует с 3 октября 2001 года.
EOT;
        $params['keyboard'] = $this->encodedKeyboard('info');
        $this->sendAnswer($params);
    }

    private function contacts(MessageDto $message): void
    {
        $params = [];
        $params['peer_id'] = $message->getFromId();
        $params['random_id'] = 0;
        $email = config('services.patriots.email');
        $phone = config('services.patriots.phone');
        $params['message'] = <<<EOT
Контакты для связи:

Почта клуба: $email
Телефон для связи(Telegram/WhatsApp): $phone
EOT;
        $params['keyboard'] = $this->encodedKeyboard('info');
        $this->sendAnswer($params);
    }

    private function tournaments(MessageDto $message): void
    {
        $params = [];
        $params['peer_id'] = $message->getFromId();
        $params['random_id'] = 0;
        // TODO text + keyboard
        $params['message'] = <<<EOT
На текущий момент команда участвует в турнирах:

Восточно-Европейская Суперлига. Сайт чемпионата: https://eesl.pro
EOT;
        $params['keyboard'] = $this->encodedKeyboard('info');
        $this->sendAnswer($params);
    }

    private function partnership(MessageDto $message, UserDto $user): void
    {
        $params = [];
        $params['peer_id'] = $message->getFromId();
        $params['random_id'] = 0;
        $firstName = $user->getFirstName();

        $params['message'] = <<<EOT
$firstName, Мы рассматриваем любые предложения о сотрудничестве: спонсорство, бартер

Какой вариант Вас интересует?
EOT;
        $params['keyboard'] = $this->encodedKeyboard('partnership');
        $this->sendAnswer($params);
    }

    private function sponsorship(MessageDto $message, UserDto $user): void
    {
        $params = [];
        $params['peer_id'] = $message->getFromId();
        $params['random_id'] = 0;
        $firstName = $user->getFirstName();
        $email = config('services.patriots.email');

        $params['message'] = <<<EOT
$firstName, мы рады выслушать Ваше спонсорское предложение.
Для продолжения диалога просим направить презентацию предложения на нашу почту: $email
EOT;
        $params['keyboard'] = $this->encodedKeyboard('info');
        $this->sendAnswer($params);
    }

    private function barter(MessageDto $message, UserDto $user): void
    {
        $params = [];
        $params['peer_id'] = $message->getFromId();
        $params['random_id'] = 0;
        $firstName = $user->getFirstName();
        $email = config('services.patriots.email');

        $params['message'] = <<<EOT
$firstName, мы рады сотрудничать по бартерному обмену.
Для продолжения диалога просим направить презентацию предложения на нашу почту: $email
EOT;
        $params['keyboard'] = $this->encodedKeyboard('info');
        $this->sendAnswer($params);
    }
}
