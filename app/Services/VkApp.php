<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class VkApp
{
    private Client $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => config('services.vk.api_url')
        ]);

    }
    public function send(string $method, array $params = []): string {
        $params['access_token'] = config('services.vk.access_token');
        $params['v'] = config('services.vk.api_version');

        try {
            $response = $this->client->get($method . http_build_query($params));
            $data = json_decode($response->getBody()->getContents());
            return $data['response'];
        } catch (GuzzleException $e) {
            return 'false';
        }
    }

    public function uploadFile(string $url, string $fileName): string
    {
        // TODO : upload file method
        return '';
    }
}
