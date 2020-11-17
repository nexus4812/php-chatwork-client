<?php

declare(strict_types=1);

namespace Nexus\ChatworkClient\Entities\Factories;

use Nexus\ChatworkClient\Api\TestData\IncomingRequestResult;
use Nexus\ChatworkClient\Entities\IncomingRequest;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 * @coversNothing
 */
final class IncomingRequestFactoryTest extends TestCase
{
    use IncomingRequestResult;

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
        yield [$factory->entity($this->incomingRequestItemGet())];
        yield [$factory->entities($this->incomingRequestItemsGet())[0]];
        yield [$factory->entitiesAsCollection($this->incomingRequestItemsGet())->first()];
    }
}
