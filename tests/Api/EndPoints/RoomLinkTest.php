<?php

declare(strict_types=1);

namespace Nexus\ChatworkClient\Api\EndPoints;

use Nexus\ChatworkClient\Api\TestData\LinkResult;
use Nexus\ChatworkClient\Client\ClientInterface;
use Nexus\ChatworkClient\Entities\Factories\LinkFactory;
use Nexus\ChatworkClient\Entities\Link;
use Nexus\ChatworkClient\Request\Builder\RoomLinkBuilder;
use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;

/**
 * @internal
 * @coversNothing
 */
final class RoomLinkTest extends TestCase
{
    use ProphecyTrait;
    use LinkResult;

    public function testLinkGet(): void
    {
        $roomId = 1;
        $clientProphecy = $this->prophesize(ClientInterface::class);

        $clientProphecy->get("rooms/{$roomId}/link")->willReturn($this->linkItemGet());

        $endPoint = new RoomLinkEndPoint($clientProphecy->reveal(), new LinkFactory(), $roomId);
        static::assertInstanceOf(Link::class, $endPoint->getRoomLink());
    }

    public function testLinkPostWithRequired(): void
    {
        $roomId = 1234;
        $clientProphecy = $this->prophesize(ClientInterface::class);

        $clientProphecy->post("rooms/{$roomId}/link")->willReturn($this->linkItemGet());
        $endPoint = new RoomLinkEndPoint($clientProphecy->reveal(), new LinkFactory(), $roomId);

        $link = $endPoint->postRoomLinkWithRequired();
        static::assertInstanceOf(Link::class, $link);
    }

    public function testLinkPost(): void
    {
        $roomId = 1234;
        $clientProphecy = $this->prophesize(ClientInterface::class);

        $builder = (new RoomLinkBuilder())->setNeedAcceptance(false);

        $clientProphecy->post("rooms/{$roomId}/link", $builder->build())->willReturn($this->linkItemGet());
        $endPoint = new RoomLinkEndPoint($clientProphecy->reveal(), new LinkFactory(), $roomId);

        $link = $endPoint->postRoomLink($builder);
        static::assertInstanceOf(Link::class, $link);
    }

    public function testLinkPut(): void
    {
        $roomId = 1234;
        $clientProphecy = $this->prophesize(ClientInterface::class);

        $builder = (new RoomLinkBuilder())->setNeedAcceptance(false);

        $clientProphecy->put("rooms/{$roomId}/link", $builder->build())->willReturn($this->linkItemGet());
        $endPoint = new RoomLinkEndPoint($clientProphecy->reveal(), new LinkFactory(), $roomId);

        $link = $endPoint->putRoomLink($builder);
        static::assertInstanceOf(Link::class, $link);
    }

    public function testDeleteLink(): void
    {
        $roomId = 1234;
        $clientProphecy = $this->prophesize(ClientInterface::class);

        $clientProphecy->delete("rooms/{$roomId}/link")->willReturn($this->linkItemDelete());
        $endPoint = new RoomLinkEndPoint($clientProphecy->reveal(), new LinkFactory(), $roomId);

        static::assertFalse($endPoint->deleteRoomLink());
    }
}
