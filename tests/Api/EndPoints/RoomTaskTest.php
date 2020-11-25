<?php

declare(strict_types=1);

namespace Nexus\ChatworkClient\Api\EndPoints;

use Nexus\ChatworkClient\Api\TestData\TaskResult;
use Nexus\ChatworkClient\Client\ClientInterface;
use Nexus\ChatworkClient\Entities\Factories\TaskFactory;
use Nexus\ChatworkClient\Entities\Task;
use Nexus\ChatworkClient\Request\Builder\PostTaskBuilder;
use Nexus\ChatworkClient\Request\Enum\TaskStatus;
use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;

/**
 * @internal
 * @coversNothing
 */
final class RoomTaskTest extends TestCase
{
    use ProphecyTrait;
    use TaskResult;

    public function testGetItems(): void
    {
        $roomId = 123;
        $taskId = 456;
        $clientProphecy = $this->prophesize(ClientInterface::class);

        $clientProphecy->get("rooms/{$roomId}/tasks")->willReturn($this->taskItemsGet());
        $clientProphecy->get("rooms/{$roomId}/tasks/{$taskId}")->willReturn($this->taskItemGet());

        $endPoint = new RoomTaskEndPoint($clientProphecy->reveal(), new TaskFactory(), $roomId);
        static::assertInstanceOf(Task::class, $endPoint->getRoomTasks()->first());
        static::assertInstanceOf(Task::class, $endPoint->getRoomTask($taskId));
    }

    public function testPost(): void
    {
        $roomId = 1234;
        $clientProphecy = $this->prophesize(ClientInterface::class);

        $clientProphecy->post("rooms/{$roomId}/tasks", ['to_ids' => 789, 'body' => 'Buy milk'])->willReturn($this->taskResultPost());
        $endPoint = new RoomTaskEndPoint($clientProphecy->reveal(), new TaskFactory(), $roomId);

        $builder = new PostTaskBuilder();

        $builder->setToId(789)->setBody('Buy milk');

        static::assertSame([123, 124], $endPoint->postRoomsTasks($builder));
    }

    public function testPutStatus(): void
    {
        $roomId = 1234;
        $taskId = 456;
        $clientProphecy = $this->prophesize(ClientInterface::class);

        $clientProphecy->put("rooms/{$roomId}/tasks/{$taskId}/status", ['body' => 'done'])->willReturn($this->taskResultPut());

        $endPoint = new RoomTaskEndPoint($clientProphecy->reveal(), new TaskFactory(), $roomId);

        $link = $endPoint->putRoomTaskStatus($taskId, TaskStatus::done());
        static::assertSame(1234, $link);
    }
}
