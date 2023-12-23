<?php

namespace App\Services\Handlers;

use App\DTO\VkCallbackDto\VkNewEventDto;
use App\Services\VkApp;

abstract class VkCallbackHandlerAbstract
{
    protected VkApp $app;

    public function __construct(protected readonly VkNewEventDto $dto)
    {
        $this->app = new VkApp();
    }
    abstract public function handle();
}
