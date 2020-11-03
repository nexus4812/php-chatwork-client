<?php

namespace ChatWorkClient\Client;

use RuntimeException;

interface ClientInterface
{
    /**
     * @param array<string, int> $query
     *
     * @return array<string, array<string>>
     *
     * @throws RuntimeException
     */
    public function get(string $path, array $query = []): array;

    /**
     * @param array<string, int> $data
     *
     * @return array<string, array<string>>
     *
     * @throws RuntimeException
     */
    public function post(string $path, array $data = []): array;

    /**
     * @param array<string, int> $data
     *
     * @return array<string, array<string>>
     *
     * @throws RuntimeException
     */
    public function put(string $path, array $data = []): array;

    /**
     * @param array<string, int> $query
     *
     * @return array<string, array<string>>
     *
     * @throws RuntimeException
     */
    public function delete(string $path, array $query = []): array;
}
