<?php

declare(strict_types=1);

namespace Nexus\ChatworkClient\Api\EndPoints;

use Nexus\ChatworkClient\Api\TestData\TaskResult;
use Nexus\ChatworkClient\Client\ClientInterface;
use Nexus\ChatworkClient\Entities\Factories\TaskFactory;
use Nexus\ChatworkClient\Entities\Task;
use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;

/**
 * @internal
 * @coversNothing
 */
final class MyTaskEndPointTest extends TestCase
{
    use ProphecyTrait;
    use TaskResult;

    public function testGetTasks(): void
    {
        $clientProphecy = $this->prophesize(ClientInterface::class);
        $clientProphecy->get('my/tasks')->willReturn($this->taskItemsGet());
        $endPoint = new MyTaskEndPoint($clientProphecy->reveal(), new TaskFactory());
        static::assertInstanceOf(Task::class, $endPoint->getTasks()->first());
    }
}
