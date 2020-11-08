<?php

declare(strict_types=1);

namespace Nexus\ChatworkClient\Api\EndPoints;

use Nexus\ChatworkClient\Client\ClientInterface;
use Nexus\ChatworkClient\Entities\Contacts;
use Nexus\ChatworkClient\Entities\Factories\ContactsFactory;
use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;

/**
 * @internal
 * @coversNothing
 */
final class ContactsEndPointTest extends TestCase
{
    use ProphecyTrait;

    /**
     * @dataProvider providerResponseData
     */
    public function testGetContacts(array $apiResult): void
    {
        $clientProphecy = $this->prophesize(ClientInterface::class);
        $clientProphecy->get('contacts')->willReturn($apiResult);

        $endPoint = new ContactsEndPoint($clientProphecy->reveal(), new ContactsFactory());

        static::assertSame($endPoint->getContacts()[0]->account_id, $apiResult[0]['account_id']);
        static::assertInstanceOf(Contacts::class, $endPoint->getContacts()[0]);
    }

    public function providerResponseData(): array
    {
        $r = json_decode('[
  {
    "account_id": 123,
    "room_id": 322,
    "name": "John Smith",
    "chatwork_id": "tarochatworkid",
    "organization_id": 101,
    "organization_name": "Hello Company",
    "department": "Marketing",
    "avatar_image_url": "https://example.com/abc.png"
  }
]', true);

        return [[$r]];
    }
}
