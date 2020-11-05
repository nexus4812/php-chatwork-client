<?php

declare(strict_types=1);

namespace ChatWorkClient\Entities\Factories;

use ChatWorkClient\Entities\Contacts;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 * @coversNothing
 */
class ContactsFactoryTest extends TestCase
{
    /**
     * @dataProvider providerContactData
     */
    public function testContactFactory(Contacts $contact): void
    {
        $this->assertInstanceOf(Contacts::class, $contact);
        $this->assertSame($contact->account_id, 123);
        $this->assertSame($contact->room_id, 322);
        $this->assertSame($contact->name, 'John Smith');
        $this->assertSame($contact->chatwork_id, 'tarochatworkid');
        $this->assertSame($contact->organization_id, 101);
        $this->assertSame($contact->organization_name, 'Hello Company');
        $this->assertSame($contact->department, 'Marketing');
        $this->assertSame($contact->avatar_image_url, 'https://example.com/abc.png');
    }

    public function providerContactData(): iterable
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
