<?php

namespace App\Providers;

use App\DTO\VkCallbackDto\MessageEventDto;
use App\DTO\VkCallbackDto\NewMessageDto;
use App\DTO\VkCallbackDto\VkNewEventDto;
use App\DTO\VkCallbackDto\VkObjectDtoInterface;
use App\Services\Handlers\{MessageEventHandler, VkCallbackHandlerAbstract, MessageHandler};
use Illuminate\Support\ServiceProvider;

class VkHandlersProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $type = request()->post('type');
        switch ($type) {
            case 'message_new':
                $this->app->bind(VkCallbackHandlerAbstract::class, function ($app) {
                    return new MessageHandler(new VkNewEventDto(request()->post()));
                });
                $objectData = request()->post('object');
                $this->app->bind(VkObjectDtoInterface::class, function ($app) use ($objectData) {
                    return NewMessageDto::createFromArray($objectData);
                });
                break;
            case 'message_event':
                $this->app->bind(VkCallbackHandlerAbstract::class, function ($app) {
                    return new MessageEventHandler(new VkNewEventDto(request()->post()));
                });
                $objectData = request()->post('object');
                $this->app->bind(VkObjectDtoInterface::class, function ($app) use ($objectData) {
                    return MessageEventDto::createFromArray($objectData);
                });
                break;
        }
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
