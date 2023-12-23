<?php

namespace App\Console\Commands;

use GuzzleHttp\Client;
use Illuminate\Console\Command;

class VkTestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:vk-test-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $client = new Client(
            [
                'base_uri' => config('services.vk.api_url')
            ]
        );
        $params = [
            'access_token' => config('services.vk.access_token'),
            'v' => config('services.vk.api_version'),
            'user_id' => 115775976
        ];
        var_dump($params);
        $response = $client->get('users.get?' . http_build_query($params));
        $response = $response->getBody()->getContents();
        print_r($response);
        $response = json_decode($response);
        var_dump($response->response[0]);
    }
}
