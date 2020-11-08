<?php

declare(strict_types=1);

namespace Nexus\ChatworkClient\Entities\Factories;

use Nexus\ChatworkClient\Entities\EntitiesRoom;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 * @coversNothing
 */
final class EntitiesRoomFactoryTest extends TestCase
{
    /**
     * @dataProvider providerEntity
     */
    public function testFactory(EntitiesRoom $contact): void
    {
        static::assertInstanceOf(EntitiesRoom::class, $contact);
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
    }

    public function providerEntity(): iterable
    {
        $factory = new EntitiesRoomFactory();
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
}
