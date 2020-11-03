<?php

namespace ChatWorkClient\Api\EndPoints;

use ChatWorkClient\Entities\Factories\MeFactory;
use ChatWorkClient\Entities\Me;

class MeEndPointTest extends AbstractEndPointForUnit
{
    /**
     * @dataProvider providerResponseData
     */
    public function testGetMe(array $apiResult)
    {
        $clientProphecy = $this->createClientProphecy();
        $clientProphecy->get('me')->willReturn($apiResult);

        $endPoint = new MeEndPoint($clientProphecy->reveal(), new MeFactory());
        $this->assertInstanceOf(Me::class, $endPoint->getMe());
    }

    public function providerResponseData()
    {
        $data = json_decode('{
                  "account_id": 123,
                  "room_id": 322,
                  "name": "John Smith",
                  "chatwork_id": "tarochatworkid",
                  "organization_id": 101,
                  "organization_name": "Hello Company",
                  "department": "Marketing",
                  "title": "CMO",
                  "url": "http://mycompany.com",
                  "introduction": "Self Introduction",
                  "mail": "taro@example.com",
                  "tel_organization": "XXX-XXXX-XXXX",
                  "tel_extension": "YYY-YYYY-YYYY",
                  "tel_mobile": "ZZZ-ZZZZ-ZZZZ",
                  "skype": "myskype_id",
                  "facebook": "myfacebook_id",
                  "twitter": "mytwitter_id",
                  "avatar_image_url": "https://example.com/abc.png"
                }', true);

        return [
            [$data],
        ];
    }
}
