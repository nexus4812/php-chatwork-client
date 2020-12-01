<?php

declare(strict_types=1);

namespace Nexus\ChatworkClient\Client;

use Nexus\ChatworkClient\Exception\ClinetException;

interface ClientInterface
{
    /**
     * @param array<string, int> $query
     *
     * @throws ClinetException
     *
     * @return array<string, array<string>>
     */
    public function get(string $path, array $query = []): array;

    /**
     * @param array<string, int> $data
     *
     * @throws ClinetException
     *
     * @return array<string, array<string>>
     */
    public function post(string $path, array $data = []): array;

    /**
     * @param array<string, int> $data
     *
     * @throws ClinetException
     *
     * @return array<string, array<string>>
     */
    public function put(string $path, array $data = []): array;

    /**
     * @param array<string, int> $query
     *
     * @throws ClinetException
     *
     * @return array<string, array<string>>|null
     */
    public function delete(string $path, array $query = []);

    /**
     * @param array<string, int> $data
     *
     * @throws ClinetException
     *
     * @return array<string, array<string>>
     */
    public function postMultipart(string $path, array $data = []): array;
}
