<?php

declare(strict_types=1);

namespace Nexus\ChatworkClient\Api\EndPoints;

use Nexus\ChatworkClient\Api\TestData\RoomResult;
use Nexus\ChatworkClient\Client\ClientInterface;
use Nexus\ChatworkClient\Entities\Factories\RoomFactory;
use Nexus\ChatworkClient\Entities\Room;
use Nexus\ChatworkClient\Request\Builder\PostRoomBuilder;
use Nexus\ChatworkClient\Request\Builder\PutRoomBuilder;
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

    public function testRoomGet(): void
    {
        $roomId = 1;
        $clientProphecy = $this->prophesize(ClientInterface::class);

        $clientProphecy->get('rooms')->willReturn($this->roomItemsGet());
        $clientProphecy->get("rooms/{$roomId}")->willReturn($this->roomItemGet());
        $clientProphecy->delete("rooms/{$roomId}", ['action_type' => ActionType::delete()->toString()])->willReturn(null);

        $endPoint = new RoomEndPoint($clientProphecy->reveal(), new RoomFactory());
        static::assertInstanceOf(Room::class, $endPoint->getRooms()->first());
        static::assertInstanceOf(Room::class, $endPoint->getRoom($roomId));
        static::assertInstanceOf(Room::class, $endPoint->getRoom($roomId));
        static::assertNull($endPoint->deleteRoom($roomId, ActionType::delete()));
    }

    public function testRoomPost(): void
    {
        $roomId = 1234;
        $clientProphecy = $this->prophesize(ClientInterface::class);
        $query = ['name' => 'name_test', 'members_admin_ids' => '5678'];

        $clientProphecy->post('rooms', $query)->willReturn($this->roomItemsPutAndPost());
        $endPoint = new RoomEndPoint($clientProphecy->reveal(), new RoomFactory());

        $ReturnRoomId = $endPoint->postRoomByBuilder(
            (new PostRoomBuilder())->setName('name_test')->setMembersAdminIds([5678])
        );

        static::assertSame($roomId, $ReturnRoomId);
    }

    public function testRoomPut(): void
    {
        $roomId = 1234;
        $clientProphecy = $this->prophesize(ClientInterface::class);
        $query = ['name' => 'name_test', 'description' => 'description_test', 'icon_preset' => IconPreset::sport()];
        $clientProphecy->put("rooms/{$roomId}", $query)->willReturn($this->roomItemsPutAndPost());

        $endPoint = new RoomEndPoint($clientProphecy->reveal(), new RoomFactory());
        $builder = new PutRoomBuilder();

        $builder->setName('name_test')->setDescription('description_test')->setIconPreset(IconPreset::sport());

        static::assertSame($roomId, $endPoint->putRoomByBuilder($roomId, $builder));
    }
}
