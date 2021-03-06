<?php

declare(strict_types=1);

namespace Nexus\ChatworkClient\Entities\Factories;

use Nexus\ChatworkClient\Api\TestData\ContactsResult;
use Nexus\ChatworkClient\Entities\Contacts;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 * @coversNothing
 */
final class ContactsFactoryTest extends TestCase
{
    use ContactsResult;

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
        yield [$factory->entity($this->contactsItemGet())];
        yield [$factory->entities($this->contactsItemsGet())[0]];
        yield [$factory->entitiesAsCollection($this->contactsItemsGet())->first()];
    }
}
