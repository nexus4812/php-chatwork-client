<?php

declare(strict_types=1);

namespace ChatWorkClient\Entities\Factories;

use ChatWorkClient\Entities\Contacts;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 * @coversNothing
 */
final class ContactsFactoryTest extends TestCase
{
    /**
     * @dataProvider providerEntity
     */
    public function testFactory(Contacts $contact): void
    {
        static::assertInstanceOf(Contacts::class, $contact);
        static::assertSame($contact->account_id, 123);
        static::assertSame($contact->room_id, 322);
        static::assertSame($contact->name, 'John Smith');
        static::assertSame($contact->chatwork_id, 'tarochatworkid');
        static::assertSame($contact->organization_id, 101);
        static::assertSame($contact->organization_name, 'Hello Company');
        static::assertSame($contact->department, 'Marketing');
        static::assertSame($contact->avatar_image_url, 'https://example.com/abc.png');
    }

    public function providerEntity(): iterable
    {
        $factory = new ContactsFactory();
        $contact = json_decode('  {
    "account_id": 123,
    "room_id": 322,
    "name": "John Smith",
    "chatwork_id": "tarochatworkid",
    "organization_id": 101,
    "organization_name": "Hello Company",
    "department": "Marketing",
    "avatar_image_url": "https://example.com/abc.png"
  }', true);
        yield [$factory->entity($contact)];

        $contacts = json_decode('  [{
    "account_id": 123,
    "room_id": 322,
    "name": "John Smith",
    "chatwork_id": "tarochatworkid",
    "organization_id": 101,
    "organization_name": "Hello Company",
    "department": "Marketing",
    "avatar_image_url": "https://example.com/abc.png"
  }]', true);
        yield [$factory->entities($contacts)[0]];
    }
}
