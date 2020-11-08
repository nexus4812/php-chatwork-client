<?php

declare(strict_types=1);

namespace ChatWorkClient\Api\EndPoints;

use ChatWorkClient\Client\ClientInterface;
use ChatWorkClient\Entities\Factories\MyTaskFactory;
use ChatWorkClient\Entities\Factories\StatusFactory;
use ChatWorkClient\Entities\Status;
use ChatWorkClient\Entities\Task;
use Illuminate\Support\Collection;

class MyEndPoint extends AbstractEndPoint
{
    /**
     * @var StatusFactory
     */
    private $statusFactory;

    /**
     * @var MyTaskFactory
     */
    private $taskFactory;

    public function __construct(
        ClientInterface $client,
        StatusFactory $factory,
        MyTaskFactory $taskFactory
    ) {
        parent::__construct($client);
        $this->statusFactory = $factory;
        $this->taskFactory = $taskFactory;
    }

    public function getStatus(): Status
    {
        return $this->statusFactory->entity($this->client->get('my/status'));
    }

    /**
     * @return array<Task>|Collection
     */
    public function getTasks(): Collection
    {
        return $this->taskFactory->entitiesAsCollection($this->client->get('my/tasks'));
    }
}
