<?php

declare(strict_types=1);

namespace Nexus\ChatworkClient\Api\EndPoints;

use Nexus\ChatworkClient\Client\ClientInterface;
use Nexus\ChatworkClient\Entities\Factories\StatusFactory;
use Nexus\ChatworkClient\Entities\Status;
use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;

/**
 * @internal
 * @coversNothing
 */
final class MyStatusEndPointTest extends TestCase
{
    use ProphecyTrait;

    /**
     * @dataProvider providerStateData
     */
    public function testGetState($data): void
    {
        $clientProphecy = $this->prophesize(ClientInterface::class);
        $clientProphecy->get('my/status')->willReturn($data);

        $endPoint = new MyStatusEndPoint($clientProphecy->reveal(), new StatusFactory());
        static::assertInstanceOf(Status::class, $endPoint->getStatus());
    }

    public function providerStateData()
    {
        $data = json_decode('{
  "unread_room_num": 2,
  "mention_room_num": 1,
  "mytask_room_num": 3,
  "unread_num": 12,
  "mention_num": 1,
  "mytask_num": 8
}', true);

        return [
            [$data],
        ];
    }
}
