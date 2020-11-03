<?php

namespace ChatWorkClient\Client;

use GuzzleHttp\Client;
use GuzzleHttp\Exception;

class GuzzleClient implements ClientInterface
{
    /**
     * @var Client
     */
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @throws Exception\GuzzleException
     */
    public function get(string $path, array $query = []): array
    {
        return $this->jsonDecode($this->client->get($path, ['query' => $query])->getBody()->getContents());
    }

    /**
     * @throws Exception\GuzzleException
     */
    public function post(string $path, array $data = []): array
    {
        return $this->jsonDecode($this->client->post($path, $data)->getBody()->getContents());
    }

    /**
     * @throws Exception\GuzzleException
     */
    public function put(string $path, array $data = []): array
    {
        return $this->jsonDecode($this->client->put($path, $data)->getBody()->getContents());
    }

    /**
     * @throws Exception\GuzzleException
     */
    public function delete(string $path, array $query = []): array
    {
        return $this->jsonDecode($this->client->put($path, ['query' => $query])->getBody()->getContents());
    }

    private function jsonDecode(string $json): array
    {
        return json_decode($json, true);
    }
}
