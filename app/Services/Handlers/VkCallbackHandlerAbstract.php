<?php

namespace App\Services\Handlers;

use App\DTO\VkCallbackDto\VkNewEventDto;
use App\Services\VkApp;

abstract class VkCallbackHandlerAbstract
{
    protected const MENU_STATES = ['main_menu', 'info'];
    protected const MENU_MESSAGE_TEXT = [
        'main_menu' => 'Главное меню',
        'info' => 'Информация о клубе',
    ];
    protected VkApp $app;

    public function __construct(protected readonly VkNewEventDto $dto)
    {
        $this->app = new VkApp();
    }
    abstract public function handle();
    protected function encodedKeyboard(string $menuKey): string
    {
        return json_encode(config('menu.' . $menuKey));
    }
}
