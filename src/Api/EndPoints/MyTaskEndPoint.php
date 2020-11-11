<?php

declare(strict_types=1);

namespace Nexus\ChatworkClient\Api\EndPoints;

use Illuminate\Support\Collection;
use Nexus\ChatworkClient\Client\ClientInterface;
use Nexus\ChatworkClient\Entities\Factories\TaskFactory;
use Nexus\ChatworkClient\Entities\Task;

class MyTaskEndPoint extends AbstractEndPoint
{
    /**
     * @var TaskFactory
     */
    protected $factory;

    public function __construct(ClientInterface $client, TaskFactory $factory)
    {
        parent::__construct($client, $factory);
    }

    /**
     * @return array<Task>|Collection
     */
    public function getTasks(): Collection
    {
        return $this->factory->entitiesAsCollection($this->client->get('my/tasks'));
    }
}
