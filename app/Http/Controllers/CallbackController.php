<?php

namespace App\Http\Controllers;

use App\Http\Requests\VkCallbackRequest;
use App\Services\Handlers\VkCallbackHandlerAbstract;
use Illuminate\Support\Facades\Log;

class CallbackController extends Controller
{
    /**
     * Подтверждение сервера
     * @param VkCallbackRequest $request
     * @return string
     */
    public function callbackHandler(VkCallbackRequest $request): string {
        Log::channel('vk_log')->debug('vk_request', $request->post());
        if ($request->post('type') === 'confirmation') {
            return 'b4d730f3';
        }

        try {
//            Здесь можно получить DTO
//            $dto = $request->data();
            /** @var VkCallbackHandlerAbstract $handler */
            $handler = app()->make(VkCallbackHandlerAbstract::class);
            $result = $handler->handle();
        } catch (\Throwable $e) {
            Log::channel('vk_log')->error('Error handling request: ' . $e->getMessage());
        }
        // temp code
        return $result ?? 'ok';
    }
}
