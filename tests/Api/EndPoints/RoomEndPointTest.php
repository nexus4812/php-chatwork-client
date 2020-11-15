<?php

declare(strict_types=1);

namespace Nexus\ChatworkClient\Api\EndPoints;

use Nexus\ChatworkClient\Api\TestData\RoomResult;
use Nexus\ChatworkClient\Client\ClientInterface;
use Nexus\ChatworkClient\Entities\Factories\RoomFactory;
use Nexus\ChatworkClient\Entities\Room;
use Nexus\ChatworkClient\Request\Enum\ActionType;
use Nexus\ChatworkClient\Request\Enum\IconPreset;
use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;

/**
 * @internal
 * @coversNothing
 */
final class RoomEndPointTest extends TestCase
{
    use ProphecyTrait;
    use RoomResult;

    public function testRoom(): void
    {
        $roomId = 1;
        $clientProphecy = $this->prophesize(ClientInterface::class);

        $clientProphecy->get('rooms')->willReturn($this->roomItemsGet());
        $clientProphecy->get("rooms/{$roomId}")->willReturn($this->roomItemGet());
        $clientProphecy->put("rooms/{$roomId}")->willReturn($this->roomItemsPutAndPost());
        $clientProphecy->post("rooms/{$roomId}")->willReturn($this->roomItemsPutAndPost());
        $clientProphecy->delete("rooms/{$roomId}", ['action_type' => ActionType::delete()->toString()])->willReturn(null);

        $endPoint = new RoomEndPoint($clientProphecy->reveal(), new RoomFactory());
        static::assertInstanceOf(Room::class, $endPoint->getRooms()->first());
        static::assertInstanceOf(Room::class, $endPoint->getRoom($roomId));
        static::assertSame(123, $endPoint->putRoom($roomId, IconPreset::notUsed(), 'test room', 'detail'));

        static::assertNull($endPoint->deleteRoom($roomId, ActionType::delete()));
    }
}
