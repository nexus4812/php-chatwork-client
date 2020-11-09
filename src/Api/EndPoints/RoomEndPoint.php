<?php

declare(strict_types=1);

namespace Nexus\ChatworkClient\Api\EndPoints;

use Nexus\ChatworkClient\Client\ClientInterface;
use Nexus\ChatworkClient\Entities\EntityRoom;
use Nexus\ChatworkClient\Entities\Factories\EntityRoomFactory;

class RoomEndPoint extends AbstractEndPoint
{
    /**
     * @var EntityRoomFactory
     */
    private $roomFactory;

    public function __construct(
        ClientInterface $client,
        EntityRoomFactory $roomFactory
    ) {
        parent::__construct($client);
        $this->roomFactory = $roomFactory;
    }

    /**
     * GET /rooms 自分のチャット一覧の取得.
     *
     * @return array<EntityRoom>
     */
    public function getRooms(): array
    {
        return $this->roomFactory->entities($this->client->get('rooms'));
    }

    /**
     * POST /rooms グループチャットを新規作成.
     *
     * @param array<int>   $membersAdminIds
     * @param array<mixed> $options
     *
     * @return int room_id
     */
    public function postRoom(array $membersAdminIds, string $name, $options = []): int
    {
        return $this->client->post('/rooms', array_merge([
            'members_admin_ids' => $membersAdminIds,
            'name' => $name,
        ], $options))['room_id'];
    }

    /**
     * GET /rooms/{room_id} チャットの名前、アイコン、種類(my/direct/group)を取得.
     */
    public function getRoom(int $roomId): EntityRoom
    {
        return $this->roomFactory->entity($this->client->get("rooms/{$roomId}"));
    }

    /**
     * PUT /rooms/{room_id} チャットの名前、アイコンをアップデート.
     *
     * @param array $option
     */
    public function putRoom(int $roomId, $option = []): int
    {
        return $this->roomFactory->entity($this->client->put("rooms/{$roomId}", $option))->room_id;
    }

    /**
     * @param string $actionType leave or delete
     */
    public function deleteRoom(int $roomId, string $actionType = 'leave'): void
    {
        $this->client->delete("rooms/{$roomId}", ['action_type' => $actionType]);
    }
}
