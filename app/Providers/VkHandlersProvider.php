<?php

namespace App\Providers;

use App\Services\Handlers\VkCallbackHandlerInterface;
use App\Services\MessageHandler;
use Illuminate\Support\ServiceProvider;

class VkHandlersProvider extends ServiceProvider
{
    public array $bindings = [
        VkCallbackHandlerInterface::class => MessageHandler::class
    ];
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
