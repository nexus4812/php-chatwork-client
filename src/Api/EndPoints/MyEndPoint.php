<?php

declare(strict_types=1);

namespace ChatWorkClient\Api\EndPoints;

use ChatWorkClient\Client\ClientInterface;
use ChatWorkClient\Entities\Factories\MyTaskFactory;
use ChatWorkClient\Entities\Factories\StatusFactory;
use ChatWorkClient\Entities\MyTask;
use ChatWorkClient\Entities\Status;
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
     * @return array<MyTask>
     */
    public function getTasks(): array
    {
        return $this->taskFactory->entities($this->client->get('my/tasks'));
    }

    /**
     * @return array<MyTask>|Collection
     */
    public function tasksAsCollection(): Collection
    {
        return $this->arrayToCollection($this->getTasks());
    }
}
