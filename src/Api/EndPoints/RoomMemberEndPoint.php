<?php

declare(strict_types=1);

namespace Nexus\ChatworkClient\Api\EndPoints;

use Illuminate\Support\Collection;
use Nexus\ChatworkClient\Client\ClientInterface;
use Nexus\ChatworkClient\Entities\Factories\MemberFactory;
use Nexus\ChatworkClient\Entities\Member;
use Nexus\ChatworkClient\Entities\PutMembers;
use Nexus\ChatworkClient\Request\Builder\PutMembersBuilder;

class RoomMemberEndPoint extends AbstractEndPoint
{
    /**
     * @var MemberFactory
     */
    protected $factory;

    /**
     * @var int
     */
    private $roomId;

    public function __construct(ClientInterface $client, MemberFactory $factory, int $roomId)
    {
        parent::__construct($client, $factory);
        $this->roomId = $roomId;
    }

    /**
     * GET /rooms/{room_id}/members チャットのメンバー一覧を取得.
     *
     * @return array<Member>|Collection
     *
     * @see https://developer.chatwork.com/ja/endpoint_rooms.html#GET-rooms-room_id-members
     */
    public function getRoomMembers(): Collection
    {
        return $this->factory->entitiesAsCollection(
            $this->client->get("room/{$this->roomId}/members")
        );
    }

    /**
     * PUT /rooms/{room_id}/members チャットのメンバーを一括変更.
     *
     * @see https://developer.chatwork.com/ja/endpoint_rooms.html#PUT-rooms-room_id-members
     */
    public function putRoomMembers(PutMembersBuilder $putMembersBuilder): PutMembers
    {
        return $this->factory->putEntity(
            $this->client->put("rooms/{$this->roomId}/members", $putMembersBuilder->build())
        );
    }
}
