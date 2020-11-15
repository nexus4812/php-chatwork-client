<?php

declare(strict_types=1);

namespace Nexus\ChatworkClient\Api\EndPoints;

use Nexus\ChatworkClient\Api\TestData\IncomingRequestResult;
use Nexus\ChatworkClient\Client\ClientInterface;
use Nexus\ChatworkClient\Entities\Factories\IncomingRequestFactory;
use Nexus\ChatworkClient\Entities\IncomingRequest;
use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;

/**
 * @internal
 * @coversNothing
 */
final class IncomingRequestsEndPointTest extends TestCase
{
    use ProphecyTrait;
    use IncomingRequestResult;

    public function testGetIncomingRequests(): void
    {
        $clientProphecy = $this->prophesize(ClientInterface::class);
        $clientProphecy->get('incoming_requests')->willReturn($this->incomingRequestItemsGet());

        $endPoint = new IncomingRequestsEndPoint($clientProphecy->reveal(), new IncomingRequestFactory());
        static::assertInstanceOf(IncomingRequest::class, $endPoint->getIncomingRequests()->first());
    }

    public function testPutIncomingRequests(): void
    {
        $requestId = 1;
        $clientProphecy = $this->prophesize(ClientInterface::class);
        $clientProphecy->put("incoming_requests/{$requestId}")->willReturn($this->incomingRequestItemGet());

        $endPoint = new IncomingRequestsEndPoint($clientProphecy->reveal(), new IncomingRequestFactory());
        static::assertInstanceOf(IncomingRequest::class, $endPoint->putIncomingRequests($requestId));
    }

    public function testDeleteIncomingRequests(): void
    {
        $requestId = 1;
        $clientProphecy = $this->prophesize(ClientInterface::class);
        $clientProphecy->delete("incoming_requests/{$requestId}")->willReturn(null);

        $endPoint = new IncomingRequestsEndPoint($clientProphecy->reveal(), new IncomingRequestFactory());
        static::assertNull($endPoint->deleteIncomingRequests($requestId));
    }
}
