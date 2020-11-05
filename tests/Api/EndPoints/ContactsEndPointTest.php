<?php

declare(strict_types=1);

namespace ChatWorkClient\Api\EndPoints;

use ChatWorkClient\Entities\Contacts;
use ChatWorkClient\Entities\Factories\ContactsFactory;

class ContactsEndPointTest extends AbstractEndPointForUnit
{
    /**
     * @dataProvider providerResponseData
     */
    public function testGetContacts(array $apiResult)
    {
        $clientProphecy = $this->createClientProphecy();
        $clientProphecy->get('contacts')->willReturn($apiResult);

        $endPoint = new ContactsEndPoint($clientProphecy->reveal(), new ContactsFactory());
        $this->assertSame($endPoint->getContacts()[0]->account_id, $apiResult[0]['account_id']);
        $this->assertInstanceOf(Contacts::class, $endPoint->getContacts()[0]);
    }

    public function providerResponseData(): array
    {
        return $this->jsonDataToArray('[
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
]');
    }
}
