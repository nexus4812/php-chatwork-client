<?php

declare(strict_types=1);

namespace Nexus\ChatworkClient\Api\EndPoints;

use Nexus\ChatworkClient\Client\ClientInterface;
use Nexus\ChatworkClient\Entities\Factories\MeFactory;
use Nexus\ChatworkClient\Entities\Me;
use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;

/**
 * @internal
 * @coversNothing
 */
final class MeEndPointTest extends TestCase
{
    use ProphecyTrait;

    /**
     * @dataProvider providerResponseData
     */
    public function testGetMe(array $apiResult): void
    {
        $clientProphecy = $this->prophesize(ClientInterface::class);
        $clientProphecy->get('me')->willReturn($apiResult);

        $endPoint = new MeEndPoint($clientProphecy->reveal(), new MeFactory());
        static::assertInstanceOf(Me::class, $endPoint->getMe());
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
