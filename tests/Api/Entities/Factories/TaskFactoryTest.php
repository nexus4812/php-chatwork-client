<?php

declare(strict_types=1);

namespace Nexus\ChatworkClient\Entities\Factories;

use Nexus\ChatworkClient\Entities\AssignedByAccount;
use Nexus\ChatworkClient\Entities\PostTask;
use Nexus\ChatworkClient\Entities\Task;
use Nexus\ChatworkClient\Entities\TinyRoom;
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

    /**
     * @dataProvider providerPostEntity
     */
    public function testPostEntity(PostTask $entity): void
    {
        static::assertInstanceOf(PostTask::class, $entity);

        foreach ($entity->task_ids as $id) {
            static::assertIsInt($id);
        }

        static::assertSame($entity->task_ids[0], 123);
        static::assertSame($entity->task_ids[1], 124);
    }

    public function providerPostEntity(): iterable
    {
        $factory = new TaskFactory();
        $r = json_decode('
        {
  "task_ids": [123,124]
  }     ', true);

        yield [$factory->postEntity($r)];
    }

    public function providerEntity(): iterable
    {
        $factory = new TaskFactory();
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
