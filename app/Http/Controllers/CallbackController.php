<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class CallbackController extends Controller
{
    /**
     * Подтверждение сервера
     * @param Request $request
     * @return string
     */
    public function verifyServer(Request $request): string {
        Log::channel('vk_log')->debug('vk_request', $request->post());
        if ($request->post('type') === 'confirmation') {
            return 'eee3a451';
        }
        return $this->sendEchoMessage('messages.send', $request->post());
    }

    public function sendEchoMessage(string $method, array $requestFields) {
        $userId = $requestFields['object']['message']['from_id'];
        $params = [
            'access_token' => config('services.vk.access_token'),
            'v' => config('services.vk.api_version'),
            'random_id' => random_int(1, PHP_INT_MAX),
            'user_id' => $userId,
            'reply_to' => $requestFields['object']['message']['id'],
            'message' => $requestFields['object']['message']['text'],
        ];

        $client = new Client([
            'base_uri' => config('services.vk.api_url')
        ]);

        Log::channel('vk_log')->debug('query send message', $params);

        $response = $client->get($method. '?' . http_build_query($params));
        $response = json_decode($response->getBody()->getContents(), true);
        Log::channel('vk_log')->debug('result', $response);
        return 'ok';
    }
}
