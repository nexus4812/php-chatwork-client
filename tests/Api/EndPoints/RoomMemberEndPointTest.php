<?php

declare(strict_types=1);

namespace Nexus\ChatworkClient\Api\EndPoints;

use Nexus\ChatworkClient\Api\TestData\MemberResult;
use Nexus\ChatworkClient\Client\ClientInterface;
use Nexus\ChatworkClient\Entities\Factories\MemberFactory;
use Nexus\ChatworkClient\Entities\Member;
use Nexus\ChatworkClient\Entities\PutMembers;
use Nexus\ChatworkClient\Request\Builder\PutMembersBuilder;
use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;

/**
 * @internal
 * @coversNothing
 */
final class RoomMemberEndPointTest extends TestCase
{
    use ProphecyTrait;
    use MemberResult;

    public function testGet(): void
    {
        $roomId = 123;
        $clientProphecy = $this->prophesize(ClientInterface::class);

        $clientProphecy->get("room/{$roomId}/members")->willReturn($this->memberItemsGet());

        $endPoint = new RoomMemberEndPoint($clientProphecy->reveal(), new MemberFactory(), $roomId);
        static::assertInstanceOf(Member::class, $endPoint->getRoomMembers()->first());
    }

    public function testPut(): void
    {
        $roomId = 1234;
        $clientProphecy = $this->prophesize(ClientInterface::class);

        $clientProphecy->put("rooms/{$roomId}/members", [
            'members_admin_ids' => '123,542,1001',
            'members_member_ids' => '10,103',
            'members_readonly_ids' => '6,11',
        ])->willReturn($this->memberItemPut());

        $endPoint = new RoomMemberEndPoint($clientProphecy->reveal(), new MemberFactory(), $roomId);

        $builder = (new PutMembersBuilder())
            ->setAdminId(123, 542, 1001)
            ->setMemberId(10, 103)
            ->setReadonlyId(6, 11);

        static::assertInstanceOf(PutMembers::class, $endPoint->putRoomMembers($builder));
    }
}
