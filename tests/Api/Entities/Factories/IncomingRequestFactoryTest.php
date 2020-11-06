<?php

declare(strict_types=1);

namespace ChatWorkClient\Entities\Factories;

use ChatWorkClient\Entities\IncomingRequest;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 * @coversNothing
 */
class IncomingRequestFactoryTest extends TestCase
{
    /**
     * @dataProvider providerEntity
     */
    public function testFactory(IncomingRequest $contact): void
    {
        $this->assertInstanceOf(IncomingRequest::class, $contact);
        $this->assertSame($contact->request_id, 123);
        $this->assertSame($contact->account_id, 363);
        $this->assertSame($contact->message, 'hogehoge');
        $this->assertSame($contact->name, 'John Smith');
        $this->assertSame($contact->chatwork_id, 'tarochatworkid');
        $this->assertSame($contact->organization_id, 101);
        $this->assertSame($contact->organization_name, 'Hello Company');
        $this->assertSame($contact->department, 'Marketing');
        $this->assertSame($contact->avatar_image_url, 'https://example.com/abc.png');
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
