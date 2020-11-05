<?php

declare(strict_types=1);

namespace ChatWorkClient\Client;

use RuntimeException;

interface ClientInterface
{
    /**
     * @param array<string, int> $query
     *
     * @throws RuntimeException
     *
     * @return array<string, array<string>>
     */
    public function get(string $path, array $query = []): array;

    /**
     * @param array<string, int> $data
     *
     * @throws RuntimeException
     *
     * @return array<string, array<string>>
     */
    public function post(string $path, array $data = []): array;

    /**
     * @param array<string, int> $data
     *
     * @throws RuntimeException
     *
     * @return array<string, array<string>>
     */
    public function put(string $path, array $data = []): array;

    /**
     * @param array<string, int> $query
     *
     * @throws RuntimeException
     *
     * @return array<string, array<string>>
     */
    public function delete(string $path, array $query = []): array;
}
