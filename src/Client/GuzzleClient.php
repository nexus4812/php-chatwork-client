<?php

declare(strict_types=1);

namespace Nexus\ChatworkClient\Client;

use GuzzleHttp\Client;
use GuzzleHttp\Exception;
use Nexus\ChatworkClient\Exception\ClinetException;

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

    public function get(string $path, array $query = []): array
    {
        return $this->request('get', $path, [
            'query' => $query,
        ]);
    }

    public function post(string $path, array $data = []): array
    {
        return $this->request('post', $path, [
            'form_params' => $data,
        ]);
    }

    public function put(string $path, array $data = []): array
    {
        return $this->request('put', $path, [
            'form_params' => $data,
        ]);
    }

    public function delete(string $path, array $query = []): array
    {
        return $this->request('delete', $path, [
            'query' => $query,
        ]);
    }

    public function postMultipart(string $path, array $data = []): array
    {
        return $this->request('post', $path, [
            'multipart' => $data,
        ]);
    }

    /**
     * @throws ClinetException
     */
    private function request(string $method, string $path, array $options = []): array
    {
        try {
            return json_decode($this->client->request($method, $path, $options)->getBody()->getContents(), true);
        } catch (Exception\GuzzleException $e) {
            throw new ClinetException(sprintf('Request error. method = %s, path = %s', $method, $path), $e->getCode(), $e);
        }
    }
}
