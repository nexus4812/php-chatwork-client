<?php

declare(strict_types=1);

namespace ChatWorkClient\Entities\Factories;

use ChatWorkClient\Entities\EntityRoom;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 * @coversNothing
 */
final class EntityRoomFactoryTest extends TestCase
{
    /**
     * @dataProvider providerEntity
     */
    public function testFactory(EntityRoom $contact): void
    {
        static::assertInstanceOf(EntityRoom::class, $contact);
        static::assertSame($contact->room_id, 123);
        static::assertSame($contact->name, 'Group Chat Name');
        static::assertSame($contact->type, 'group');
        static::assertSame($contact->role, 'admin');
        static::assertSame($contact->sticky, false);
        static::assertSame($contact->unread_num, 10);
        static::assertSame($contact->mention_num, 1);

        static::assertSame($contact->mytask_num, 0);
        static::assertSame($contact->message_num, 122);
        static::assertSame($contact->file_num, 10);
        static::assertSame($contact->task_num, 17);

        static::assertSame($contact->icon_path, 'https://example.com/ico_group.png');
        static::assertSame($contact->last_update_time, 1298905200);

        /**
         * エンドポイント GET /rooms ではこのプロパティは存在しない
         */
        static::assertSame($contact->description, 'room description text');
    }

    public function providerEntity(): iterable
    {
        $factory = new EntityRoomFactory();
        $items = json_decode('
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
        yield [$factory->entity($items)];
    }
}
