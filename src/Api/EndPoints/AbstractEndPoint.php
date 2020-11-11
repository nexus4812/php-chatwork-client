<?php

declare(strict_types=1);

namespace Nexus\ChatworkClient\Api\EndPoints;

use Illuminate\Support\Collection;
use Nexus\ChatworkClient\Client\ClientInterface;
use Nexus\ChatworkClient\Entities\Factories\EntityFactoryInterface;

abstract class AbstractEndPoint
{
    /**
     * @var ClientInterface
     */
    protected $client;

    /**
     * @var EntityFactoryInterface
     */
    protected $factory;

    public function __construct(ClientInterface $client, EntityFactoryInterface $factory)
    {
        $this->client = $client;
        $this->factory = $factory;
    }

    protected function arrayToCollection(array $array): Collection
    {
        return new Collection($array);
    }
}
