<?php

declare(strict_types=1);

namespace ChatWorkClient\Entities\Factories;

use ChatWorkClient\Entities\AssignedByAccount;
use ChatWorkClient\Entities\MyTask;
use ChatWorkClient\Entities\TinyRoom;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 * @coversNothing
 */
class MyTaskFactoryTest extends TestCase
{
    /**
     * @dataProvider providerEntity
     */
    public function testFactory(MyTask $entity): void
    {
        $this->assertInstanceOf(MyTask::class, $entity);
        $this->assertSame($entity->task_id, 3);

        $this->assertInstanceOf(TinyRoom::class, $entity->room);
        $this->assertSame($entity->room->room_id, 5);
        $this->assertSame($entity->room->name, 'Group Chat Name');
        $this->assertSame($entity->room->icon_path, 'https://example.com/ico_group.png');

        $this->assertInstanceOf(AssignedByAccount::class, $entity->assigned_by_account);
        $this->assertSame($entity->assigned_by_account->account_id, 456);
        $this->assertSame($entity->assigned_by_account->name, 'Anna');
        $this->assertSame($entity->assigned_by_account->avatar_image_url, 'https://example.com/def.png');

        $this->assertSame($entity->message_id, '13');
        $this->assertSame($entity->body, 'buy milk');
        $this->assertSame($entity->limit_time, 1384354799);
        $this->assertSame($entity->status, 'open');
        $this->assertSame($entity->limit_type, 'date');
    }

    public function providerEntity(): iterable
    {
        $factory = new MyTaskFactory();
        $r = json_decode('
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
  }', true);
        yield [$factory->entity($r)];

        $r = json_decode('
        [
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
        yield [$factory->entities($r)[0]];
    }
}
