<?php

declare(strict_types=1);

namespace ChatWorkClient\Api\EndPoints;

use ChatWorkClient\Client\ClientInterface;
use ChatWorkClient\Entities\Factories\IncomingRequestFactory;
use ChatWorkClient\Entities\IncomingRequest;
use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;

/**
 * @internal
 * @coversNothing
 */
final class IncomingRequestsEndPointTest extends TestCase
{
    use ProphecyTrait;

    /**
     * @dataProvider providerGetResponseData
     */
    public function testGetIncomingRequests(array $apiResult): void
    {
        $clientProphecy = $this->prophesize(ClientInterface::class);
        $clientProphecy->get('incoming_requests')->willReturn($apiResult);

        $endPoint = new IncomingRequestsEndPoint($clientProphecy->reveal(), new IncomingRequestFactory());
        static::assertSame($endPoint->getIncomingRequests()[0]->request_id, $apiResult[0]['request_id']);
        static::assertInstanceOf(IncomingRequest::class, $endPoint->getIncomingRequests()[0]);
    }

    /**
     * @dataProvider providerPutResponseData
     */
    public function testPutIncomingRequests(array $apiResult): void
    {
        $requestId = 1;
        $clientProphecy = $this->prophesize(ClientInterface::class);
        $clientProphecy->put("incoming_requests/{$requestId}")->willReturn($apiResult);

        $endPoint = new IncomingRequestsEndPoint($clientProphecy->reveal(), new IncomingRequestFactory());
        static::assertInstanceOf(IncomingRequest::class, $endPoint->putIncomingRequests($requestId));
    }

    public function providerGetResponseData()
    {
        $r = json_decode('[
  {
    "request_id": 123,
    "account_id": 363,
    "message": "hogehoge",
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

    public function providerPutResponseData()
    {
        $r = json_decode(
            '{
  "account_id": 363,
  "room_id": 1234,
  "name": "John Smith",
  "chatwork_id": "tarochatworkid",
  "organization_id": 101,
  "organization_name": "Hello Company",
  "department": "Marketing",
  "avatar_image_url": "https://example.com/abc.png"}', true);

        return [[$r]];
    }
}
