<?php

namespace ChatWorkClient\Api\EndPoints;

use ChatWorkClient\Client\ClientInterface;
use Tightenco\Collect\Support\Collection;

abstract class AbstractEndPoint
{
    /**
     * @var ClientInterface
     */
    protected $client;

    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    protected function arrayToCollection(array $array): Collection
    {
        return new Collection($array);
    }
}
