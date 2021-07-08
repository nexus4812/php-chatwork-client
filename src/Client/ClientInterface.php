<?php

declare(strict_types=1);

namespace Nexus\ChatworkClient\Client;

use Nexus\ChatworkClient\Exception\ClientException;

interface ClientInterface
{
    /**
     * @param array<string|int> $query
     *
     * @return array<string|array<string>>
     *
     *@throws ClientException
     */
    public function get(string $path, array $query = []): array;

    /**
     * @param string $path
     * @param array<string|int> $data
     *
     * @return array<string|int|array<string>>
     *
     * @throws ClientException
     */
    public function post(string $path, array $data = []): array;

    /**
     * @param string $path
     * @param array<string, int> $data
     *
     * @return array<string|int|array<string>>
     *
     * @throws ClientException
     */
    public function put(string $path, array $data = []): array;

    /**
     * @param array<string, int> $query
     *
     * @return array<string|array<string>>|null
     *
     *@throws ClientException
     */
    public function delete(string $path, array $query = []);

    /**
     * @param string $path
     * @param array<string|int> $data
     *
     * @return array<string|int|array<string>>
     *
     * @throws ClientException
     */
    public function postMultipart(string $path, array $data = []): array;
}
