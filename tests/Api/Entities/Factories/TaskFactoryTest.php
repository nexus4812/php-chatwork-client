<?php

declare(strict_types=1);

namespace ChatWorkClient\Entities\Factories;

use ChatWorkClient\Entities\AssignedByAccount;
use ChatWorkClient\Entities\Task;
use ChatWorkClient\Entities\TinyRoom;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 * @coversNothing
 */
final class TaskFactoryTest extends TestCase
{
    /**
     * @dataProvider providerEntity
     */
    public function testFactory(Task $entity): void
    {
        static::assertInstanceOf(Task::class, $entity);
        static::assertSame($entity->task_id, 3);

        static::assertInstanceOf(TinyRoom::class, $entity->room);
        static::assertSame($entity->room->room_id, 5);
        static::assertSame($entity->room->name, 'Group Chat Name');
        static::assertSame($entity->room->icon_path, 'https://example.com/ico_group.png');

        static::assertInstanceOf(AssignedByAccount::class, $entity->assigned_by_account);
        static::assertSame($entity->assigned_by_account->account_id, 456);
        static::assertSame($entity->assigned_by_account->name, 'Anna');
        static::assertSame($entity->assigned_by_account->avatar_image_url, 'https://example.com/def.png');

        static::assertSame($entity->message_id, '13');
        static::assertSame($entity->body, 'buy milk');
        static::assertSame($entity->limit_time, 1384354799);
        static::assertSame($entity->status, 'open');
        static::assertSame($entity->limit_type, 'date');
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
        yield [$factory->entitiesAsCollection($r)->first()];
    }
}
