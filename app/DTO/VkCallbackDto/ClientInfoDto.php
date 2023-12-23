<?php

namespace App\DTO\VkCallbackDto;

class ClientInfoDto
{
//"client_info": {
//"button_actions": [
//"text",
//"vkpay",
//"open_app",
//"location",
//"open_link",
//"callback",
//"intent_subscribe",
//"intent_unsubscribe"
//],
//"keyboard": true,
//"inline_keyboard": true,
//"carousel": true,
//"lang_id": 0
//}
    private array $buttonActions;
    private bool $keyboard;
    private bool $inlineKeyboard;
    private bool $carousel;
    private int $langId;

    public function __construct(array $data)
    {
        $this->buttonActions = $data['button_actions'];
        $this->keyboard = $data['keyboard'];
        $this->inlineKeyboard = $data['inline_keyboard'];
        $this->carousel = $data['carousel'];
        $this->langId = $data['lang_id'];
    }
    /**
     * @param array $data
     * @return $this
     */
    public static function createFromArray(array $data): static
    {
        return new static($data);
    }

    public function getButtonActions(): array
    {
        return $this->buttonActions;
    }

    public function isKeyboard(): bool
    {
        return $this->keyboard;
    }

    public function isInlineKeyboard(): bool
    {
        return $this->inlineKeyboard;
    }

    public function isCarousel(): bool
    {
        return $this->carousel;
    }

    public function getLangId(): int
    {
        return $this->langId;
    }
}
