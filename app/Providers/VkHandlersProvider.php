<?php

namespace App\Providers;

use App\DTO\VkCallbackDto\VkNewEventDto;
use App\Services\Handlers\{MessageEventHandler, VkCallbackHandlerAbstract, MessageHandler};
use Illuminate\Support\ServiceProvider;

class VkHandlersProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(VkCallbackHandlerAbstract::class, function ($app) {
            return match (request()->post()['type']) {
                'message_new' => $app->makeWith(MessageHandler::class, ['dto' => VkNewEventDto::createFromRequest(request()->post())]),
                'message_event' => $app->makeWith(MessageEventHandler::class, ['dto' => VkNewEventDto::createFromRequest(request()->post())]),
            };
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
