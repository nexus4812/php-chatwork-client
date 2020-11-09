<?php

declare(strict_types=1);

namespace Nexus\ChatworkClient\Api\EndPoints;

use Illuminate\Support\Collection;
use Nexus\ChatworkClient\Client\ClientInterface;
use Nexus\ChatworkClient\Entities\Factories\MemberFactory;
use Nexus\ChatworkClient\Entities\Member;
use Nexus\ChatworkClient\Entities\PutMembers;

class RoomMemberEndPoint extends AbstractEndPoint
{
    /**
     * @var MemberFactory
     */
    private $memberFactory;

    private $roomId;

    public function __construct(
        ClientInterface $client,
        MemberFactory $memberFactory,
        int $roomId
    ) {
        parent::__construct($client);
        $this->memberFactory = $memberFactory;
        $this->roomId = $roomId;
    }

    /**
     * GET /rooms/{room_id}/members チャットのメンバー一覧を取得.
     *
     * @return array<Member>|Collection
     */
    public function getRoomMembers(): Collection
    {
        return $this->memberFactory->entitiesAsCollection($this->client->get("room/{$this->roomId}/members"));
    }

    /**
     * PUT /rooms/{room_id}/members チャットのメンバーを一括変更.
     *
     * @param array<int> $membersAdminIds
     * @param array<int> $membersMemberIds
     * @param array<int> $membersReadonlyIds
     */
    public function putRoomMembers(
        array $membersAdminIds,
        array $membersMemberIds = [],
        array $membersReadonlyIds = []
    ): PutMembers {
        return $this->memberFactory->putEntity($this->client->put("rooms/{$this->roomId}/members", [
            'members_admin_ids' => $membersAdminIds,
            'members_member_ids' => $membersMemberIds,
            'members_readonly_ids' => $membersReadonlyIds,
        ]));
    }
}