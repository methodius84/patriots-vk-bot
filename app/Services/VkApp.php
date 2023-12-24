<?php

namespace App\Services;

use App\DTO\VkApiDto\UserDto;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Log;
use Psr\Http\Message\ResponseInterface;

class VkApp
{
    private const KEY_ERROR = 'error';
    private const KEY_RESPONSE = 'response';
    private Client $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => config('services.vk.api_url')
        ]);

    }
    public function send(string $method, array $params = []): array {
        $params['access_token'] = config('services.vk.access_token');
        $params['v'] = config('services.vk.api_version');

        try {
            $response = $this->client->get($method . '?' . http_build_query($params));
            return $this->parseResponse($response);
        } catch (GuzzleException $e) {
            Log::channel('vk_log')->error('VK API ERROR: ' . $e->getCode() . ' ' . $e->getMessage());
            return [];
        }
    }

    public function uploadFile(string $url, string $fileName): string
    {
        // TODO : upload file method
        return '';
    }

    public function getUser(string $userId): UserDto
    {
        $params = [
            'user_id' => $userId
        ];
        $response = $this->send('users.get', $params);
        return UserDto::createFromResponse($response);
    }

    private function parseResponse(ResponseInterface $response)
    {
        $body = $response->getBody()->getContents();
        $decodedBody = $this->decodeBody($body);

        if (isset($decodedBody['error'])) {
            $error = $decodedBody['error'];
            // TODO throw new vk_api_error
        }

        if (isset($decodedBody['response'])) {
            return $decodedBody['response'];
        }

        return $decodedBody;
    }

    private function decodeBody(string $body): array
    {
        $decodedBody = json_decode($body, true);

        if (!is_array($decodedBody)) {
            $decodedBody = [];
        }
        return $decodedBody;
    }
}
