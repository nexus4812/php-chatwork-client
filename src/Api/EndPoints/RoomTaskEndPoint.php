<?php

declare(strict_types=1);

namespace Nexus\ChatworkClient\Api\EndPoints;

use Illuminate\Support\Collection;
use Nexus\ChatworkClient\Client\ClientInterface;
use Nexus\ChatworkClient\Entities\Factories\TaskFactory;
use Nexus\ChatworkClient\Entities\PostTask;
use Nexus\ChatworkClient\Entities\Task;
use Nexus\ChatworkClient\Request\Builder\PostRoomBuilder;
use Nexus\ChatworkClient\Request\Enum\TaskStatus;

class RoomTaskEndPoint extends AbstractEndPoint
{
    /**
     * @var TaskFactory
     */
    protected $taskFactory;

    /**
     * @var int
     */
    private $roomId;

    public function __construct(ClientInterface $client, TaskFactory $factory, int $roomId)
    {
        parent::__construct($client, $factory);
        $this->roomId = $roomId;
    }

    /**
     * GET /rooms/{room_id}/tasksチャットのタスク一覧を取得 (※100件まで取得可能。今後、より多くのデータを取得する為のページネーションの仕組みを提供予定).
     *
     * @return array<Task>|Collection
     *
     * @see https://developer.chatwork.com/ja/endpoint_rooms.html#GET-rooms-room_id-tasks
     */
    public function getRoomTasks(): Collection
    {
        return $this->taskFactory->entitiesAsCollection(
            $this->client->get("rooms/{$this->roomId}/tasks")
        );
    }

    /**
     * POST /rooms/{room_id}/tasksチャットに新しいタスクを追加.
     *
     * @see https://developer.chatwork.com/ja/endpoint_rooms.html#POST-rooms-room_id-tasks
     */
    public function postRoomsTasks(PostRoomBuilder $builder): PostTask
    {
        return $this->taskFactory->postEntity(
            $this->client->post("rooms/{$this->roomId}/tasks", $builder->build())
        );
    }

    /**
     * GET /rooms/{room_id}/tasks/{task_id}タスク情報を取得.
     *
     * @see https://developer.chatwork.com/ja/endpoint_rooms.html#GET-rooms-room_id-tasks-task_id
     */
    public function getRoomTask(int $taskId): Task
    {
        return $this->taskFactory->entity(
            $this->client->get("rooms/{$this->roomId}/tasks/{$taskId}")
        );
    }

    /**
     * PUT /rooms/{room_id}/tasks/{task_id}/statusタスク完了状態を変更する.
     *
     * @see https://developer.chatwork.com/ja/endpoint_rooms.html#PUT-rooms-room_id-tasks-task_id-status
     */
    public function putRoomTask(int $taskId, TaskStatus $status): int
    {
        return $this->client->put(
            "rooms/{$this->roomId}/tasks/{$taskId}/status", ['body' => $status->toString()]
        )['task_id'];
    }
}
