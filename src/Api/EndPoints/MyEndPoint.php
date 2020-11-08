<?php

declare(strict_types=1);

namespace Nexus\ChatworkClient\Api\EndPoints;

use Illuminate\Support\Collection;
use Nexus\ChatworkClient\Client\ClientInterface;
use Nexus\ChatworkClient\Entities\Factories\MyTaskFactory;
use Nexus\ChatworkClient\Entities\Factories\StatusFactory;
use Nexus\ChatworkClient\Entities\Status;
use Nexus\ChatworkClient\Entities\Task;

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
