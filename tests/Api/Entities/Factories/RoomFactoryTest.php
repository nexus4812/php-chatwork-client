<?php

declare(strict_types=1);

namespace Nexus\ChatworkClient\Entities\Factories;

use Nexus\ChatworkClient\Entities\Room;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 * @coversNothing
 */
final class RoomFactoryTest extends TestCase
{
    /**
     * @dataProvider providerGetEntity
     */
    public function testGetEntity(Room $entity): void
    {
        static::assertInstanceOf(Room::class, $entity);
        static::assertSame($entity->room_id, 123);
        static::assertSame($entity->name, 'Group Chat Name');
        static::assertSame($entity->type, 'group');
        static::assertSame($entity->role, 'admin');
        static::assertSame($entity->sticky, false);
        static::assertSame($entity->unread_num, 10);
        static::assertSame($entity->mention_num, 1);

        static::assertSame($entity->mytask_num, 0);
        static::assertSame($entity->message_num, 122);
        static::assertSame($entity->file_num, 10);
        static::assertSame($entity->task_num, 17);

        static::assertSame($entity->icon_path, 'https://example.com/ico_group.png');
        static::assertSame($entity->last_update_time, 1298905200);
    }

    /**
     * @dataProvider providerGetSingleEntity
     */
    public function testGetSingleEntity(Room $entity): void
    {
        static::assertInstanceOf(Room::class, $entity);
        static::assertSame($entity->room_id, 123);
        static::assertSame($entity->name, 'Group Chat Name');
        static::assertSame($entity->type, 'group');
        static::assertSame($entity->role, 'admin');
        static::assertSame($entity->sticky, false);
        static::assertSame($entity->unread_num, 10);
        static::assertSame($entity->mention_num, 1);

        static::assertSame($entity->mytask_num, 0);
        static::assertSame($entity->message_num, 122);
        static::assertSame($entity->file_num, 10);
        static::assertSame($entity->task_num, 17);

        static::assertSame($entity->icon_path, 'https://example.com/ico_group.png');

        // 単体で取得した際のみ返却される値
        static::assertSame($entity->description, 'room description text');
    }

    public function providerGetEntity(): iterable
    {
        $factory = new RoomFactory();
        $items = json_decode('
[
  {
    "room_id": 123,
    "name": "Group Chat Name",
    "type": "group",
    "role": "admin",
    "sticky": false,
    "unread_num": 10,
    "mention_num": 1,
    "mytask_num": 0,
    "message_num": 122,
    "file_num": 10,
    "task_num": 17,
    "icon_path": "https://example.com/ico_group.png",
    "last_update_time": 1298905200
  }
]', true);
        yield [$factory->entities($items)[0]];
        yield [$factory->entitiesAsCollection($items)->first()];
    }

    public function providerGetSingleEntity()
    {
        $factory = new RoomFactory();
        $r = json_decode('
{
  "room_id": 123,
  "name": "Group Chat Name",
  "type": "group",
  "role": "admin",
  "sticky": false,
  "unread_num": 10,
  "mention_num": 1,
  "mytask_num": 0,
  "message_num": 122,
  "file_num": 10,
  "task_num": 17,
  "icon_path": "https://example.com/ico_group.png",
  "last_update_time": 1298905200,
  "description": "room description text"
}', true);
        yield [$factory->entity($r)];
    }
}
