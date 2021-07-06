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
     * GET /my/tasks 自分のタスク一覧を取得する。(※100件まで取得可能。今後、より多くのデータを取得する為のページネーションの仕組みを提供予定).
     *
     * @return Collection<Task>
     *
     * @see https://developer.chatwork.com/ja/endpoint_my.html#GET-my-tasks
     */
    public function getTasks(): Collection
    {
        return $this->factory->entitiesAsCollection($this->client->get('my/tasks'));
    }
}
