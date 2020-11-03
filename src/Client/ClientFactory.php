<?php

namespace ChatWorkClient\Client;

use GuzzleHttp\Client;

class ClientFactory
{
    public function guzzleHttp(string $chatWorkToken): GuzzleClient
    {
        $client = new Client([
            'base_uri' => 'https://api.chatwork.com/v2/',
            'defaults' => [
                'timeout' => 60,
                'debug' => false,
            ],
            'headers' => [
                'Accept' => 'application/json',
                'X-ChatWorkToken' => $chatWorkToken,
            ],
        ]);

        return new GuzzleClient($client);
    }
}
