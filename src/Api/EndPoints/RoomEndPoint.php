<?php

declare(strict_types=1);

namespace Nexus\ChatworkClient\Api\EndPoints;

use Illuminate\Support\Collection;
use Nexus\ChatworkClient\Client\ClientInterface;
use Nexus\ChatworkClient\Entities\Factories\RoomFactory;
use Nexus\ChatworkClient\Entities\Room;
use Nexus\ChatworkClient\Request\Enum\ActionType;
use Nexus\ChatworkClient\Request\Enum\IconPreset;

class RoomEndPoint extends AbstractEndPoint
{
    /**
     * @var RoomFactory
     */
    protected $factory;

    public function __construct(ClientInterface $client, RoomFactory $factory)
    {
        parent::__construct($client, $factory);
    }

    /**
     * GET /rooms 自分のチャット一覧の取得.
     *
     * @return array<Room>
     */
    public function getRooms(): Collection
    {
        return $this->factory->entitiesAsCollection($this->client->get('rooms'));
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
        return $this->client->post('rooms', array_merge([
            'members_admin_ids' => $membersAdminIds,
            'name' => $name,
        ], $options))['room_id'];
    }

    /**
     * GET /rooms/{room_id} チャットの名前、アイコン、種類(my/direct/group)を取得.
     */
    public function getRoom(int $roomId): Room
    {
        return $this->factory->entity($this->client->get("rooms/{$roomId}"));
    }

    /**
     * PUT /rooms/{room_id} チャットの名前、アイコンをアップデート.
     *
     * @param array $option
     */
    public function putRoom(int $roomId, IconPreset $iconPreset, string $name = '', string $description = ''): int
    {
        return $this->client->put("rooms/{$roomId}", [
            'name' => $name,
            'icon_persent' => $iconPreset->toString(),
            'description' => $description,
        ])['room_id'];
    }

    /**
     * @param string $actionType leave or delete
     */
    public function deleteRoom(int $roomId, ActionType $actionType): void
    {
        $this->client->delete("rooms/{$roomId}", ['action_type' => $actionType->toString()]);
    }
}
