<?php


namespace ChatWorkClient\Api\EndPoints;

use ChatWorkClient\Entities\Contacts;
use ChatWorkClient\Entities\Factories\ContactsFactory;
use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;

use ChatWorkClient\Client\ClientInterface;

class TestContactsEndPoint extends TestCase
{
    use ProphecyTrait;

    /**
     * @var ClientInterface
     */
    private $client;

    /**
     * @dataProvider providerResponseData
     * @param array $apiResult
     */
    public function testGetContacts(array $apiResult)
    {
        $mock = $this->prophesize(ClientInterface::class);
        $mock->get('contacts')->willReturn($apiResult);
        $client = $mock->reveal();
        $endPoint = new ContactsEndPoint($client, new ContactsFactory());
        $this->assertSame($endPoint->getContacts()[0]->account_id, $apiResult[0]["account_id"]);
        $this->assertInstanceOf(Contacts::class, $endPoint->getContacts()[0]);
    }

    public function providerResponseData()
    {
        $data = json_decode('[
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

        return [
            [$data]
        ];
    }
}