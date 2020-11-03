<?php

namespace ChatWorkClient\Api\EndPoints;

use ChatWorkClient\Entities\Factories\IncomingRequestFactory;
use ChatWorkClient\Entities\IncomingRequest;

class IncomingRequestsEndPointTest extends AbstractEndPointForUnit
{
    /**
     * @dataProvider providerGetResponseData
     */
    public function testGetIncomingRequests(array $apiResult): void
    {
        $clientProphecy = $this->createClientProphecy();
        $clientProphecy->get('incoming_requests')->willReturn($apiResult);

        $endPoint = new IncomingRequestsEndPoint($clientProphecy->reveal(), new IncomingRequestFactory());
        $this->assertSame($endPoint->getIncomingRequests()[0]->request_id, $apiResult[0]['request_id']);
        $this->assertInstanceOf(IncomingRequest::class, $endPoint->getIncomingRequests()[0]);
    }

    /**
     * @dataProvider providerPutResponseData
     */
    public function testPutIncomingRequests(array $apiResult): void
    {
        $requestId = 1;
        $clientProphecy = $this->createClientProphecy();
        $clientProphecy->put("incoming_requests/{$requestId}")->willReturn($apiResult);

        $endPoint = new IncomingRequestsEndPoint($clientProphecy->reveal(), new IncomingRequestFactory());
        $this->assertInstanceOf(IncomingRequest::class, $endPoint->putIncomingRequests($requestId));
    }

    public function providerGetResponseData()
    {
        $this->jsonDataToArray('[
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
]');
    }

    public function providerPutResponseData()
    {
        $this->jsonDataToArray(
            '{
  "account_id": 363,
  "room_id": 1234,
  "name": "John Smith",
  "chatwork_id": "tarochatworkid",
  "organization_id": 101,
  "organization_name": "Hello Company",
  "department": "Marketing",
  "avatar_image_url": "https://example.com/abc.png"}'
        );
    }
}
