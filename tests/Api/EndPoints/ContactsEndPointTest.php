<?php

declare(strict_types=1);

namespace Nexus\ChatworkClient\Api\EndPoints;

use Nexus\ChatworkClient\Api\TestData\ContactsResult;
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
    use ContactsResult;

    public function testGetContacts(): void
    {
        $clientProphecy = $this->prophesize(ClientInterface::class);
        $clientProphecy->get('contacts')->willReturn($this->contactsItemsGet());

        $endPoint = new ContactsEndPoint($clientProphecy->reveal(), new ContactsFactory());
        static::assertInstanceOf(Contacts::class, $endPoint->getContacts()->first());
    }
}
