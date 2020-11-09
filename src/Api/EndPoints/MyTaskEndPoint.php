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
    private $taskFactory;

    public function __construct(
        ClientInterface $client,
        TaskFactory $taskFactory
    ) {
        parent::__construct($client);
        $this->taskFactory = $taskFactory;
    }

    /**
     * @return array<Task>|Collection
     */
    public function getTasks(): Collection
    {
        return $this->taskFactory->entitiesAsCollection($this->client->get('my/tasks'));
    }
}
