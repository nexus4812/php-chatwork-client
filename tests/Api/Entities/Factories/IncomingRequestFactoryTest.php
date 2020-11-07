<?php

declare(strict_types=1);

namespace ChatWorkClient\Entities\Factories;

use ChatWorkClient\Entities\IncomingRequest;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 * @coversNothing
 */
final class IncomingRequestFactoryTest extends TestCase
{
    /**
     * @dataProvider providerEntity
     */
    public function testFactory(IncomingRequest $contact): void
    {
        static::assertInstanceOf(IncomingRequest::class, $contact);
        static::assertSame($contact->request_id, 123);
        static::assertSame($contact->account_id, 363);
        static::assertSame($contact->message, 'hogehoge');
        static::assertSame($contact->name, 'John Smith');
        static::assertSame($contact->chatwork_id, 'tarochatworkid');
        static::assertSame($contact->organization_id, 101);
        static::assertSame($contact->organization_name, 'Hello Company');
        static::assertSame($contact->department, 'Marketing');
        static::assertSame($contact->avatar_image_url, 'https://example.com/abc.png');
    }

    public function providerEntity(): iterable
    {
        $factory = new IncomingRequestFactory();
        $contact = json_decode('  {
    "request_id": 123,
    "account_id": 363,
    "message": "hogehoge",
    "name": "John Smith",
    "chatwork_id": "tarochatworkid",
    "organization_id": 101,
    "organization_name": "Hello Company",
    "department": "Marketing",
    "avatar_image_url": "https://example.com/abc.png"
  }', true);
        yield [$factory->entity($contact)];

        $contacts = json_decode('  [{
    "request_id": 123,
    "account_id": 363,
    "message": "hogehoge",
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
