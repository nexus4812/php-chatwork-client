<?php

declare(strict_types=1);

namespace ChatWorkClient\Api\EndPoints;

use ChatWorkClient\Client\ClientInterface;
use ChatWorkClient\Entities\Factories\MyTaskFactory;
use ChatWorkClient\Entities\Factories\StatusFactory;
use ChatWorkClient\Entities\Status;
use ChatWorkClient\Entities\Task;
use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;

/**
 * @internal
 * @coversNothing
 */
final class MyEndPointTest extends TestCase
{
    use ProphecyTrait;

    /**
     * @dataProvider providerStateData
     */
    public function testGetState($data): void
    {
        $clientProphecy = $this->prophesize(ClientInterface::class);
        $clientProphecy->get('my/status')->willReturn($data);

        $endPoint = new MyEndPoint($clientProphecy->reveal(), new StatusFactory(), new MyTaskFactory());
        static::assertInstanceOf(Status::class, $endPoint->getStatus());
    }

    /**
     * @dataProvider providerGetTasks
     */
    public function testGetTasks($data): void
    {
        $clientProphecy = $this->prophesize(ClientInterface::class);
        $clientProphecy->get('my/tasks')->willReturn($data);
        $endPoint = new MyEndPoint($clientProphecy->reveal(), new StatusFactory(), new MyTaskFactory());

        static::assertInstanceOf(Task::class, $endPoint->getTasks()->first());
    }

    public function providerStateData()
    {
        $data = json_decode('{
  "unread_room_num": 2,
  "mention_room_num": 1,
  "mytask_room_num": 3,
  "unread_num": 12,
  "mention_num": 1,
  "mytask_num": 8
}', true);

        return [
            [$data],
        ];
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
