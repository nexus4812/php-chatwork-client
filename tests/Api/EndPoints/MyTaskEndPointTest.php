<?php

declare(strict_types=1);

namespace Nexus\ChatworkClient\Api\EndPoints;

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

    /**
     * @dataProvider providerGetTasks
     */
    public function testGetTasks($data): void
    {
        $clientProphecy = $this->prophesize(ClientInterface::class);
        $clientProphecy->get('my/tasks')->willReturn($data);
        $endPoint = new MyTaskEndPoint($clientProphecy->reveal(), new TaskFactory());

        static::assertInstanceOf(Task::class, $endPoint->getTasks()->first());
    }

    public function providerGetTasks()
    {
        $data = json_decode('[
  {
    "task_id": 3,
    "room": {
      "room_id": 5,
      "name": "Group Chat Name",
      "icon_path": "https://example.com/ico_group.png"
    },
    "assigned_by_account": {
      "account_id": 456,
      "name": "Anna",
      "avatar_image_url": "https://example.com/def.png"
    },
    "message_id": "13",
    "body": "buy milk",
    "limit_time": 1384354799,
    "status": "open",
    "limit_type": "date"
  }
]', true);

        return [
            [$data],
        ];
    }
}
