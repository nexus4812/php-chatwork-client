<?php

declare(strict_types=1);

namespace Nexus\ChatworkClient\Api\EndPoints;

use Illuminate\Support\Collection;
use Nexus\ChatworkClient\Client\ClientInterface;
use Nexus\ChatworkClient\Entities\Factories\RoomFactory;
use Nexus\ChatworkClient\Entities\Room;
use Nexus\ChatworkClient\Request\Builder\PostRoomBuilder;
use Nexus\ChatworkClient\Request\Builder\PutRoomBuilder;
use Nexus\ChatworkClient\Request\Enum\ActionType;

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
     * @return int room_id
     */
    public function postRoomByBuilder(PostRoomBuilder $builder): int
    {
        return $this->client->post('rooms', $builder->build())['room_id'];
    }

    /**
     * POST /rooms グループチャットを新規作成.
     *
     * @param array $adminIds<int>
     */
    public function postRoomWithRequired(string $name, array $adminIds): int
    {
        $builder = (new PostRoomBuilder())->setName($name)->setMembersAdminIds($adminIds);

        return $this->client->post('rooms', $builder->build())['room_id'];
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
     */
    public function putRoom(int $roomId, PutRoomBuilder $builder): int
    {
        return $this->client->put("rooms/{$roomId}", $builder->build())['room_id'];
    }

    /**
     * @param string $actionType leave or delete
     */
    public function deleteRoom(int $roomId, ActionType $actionType): void
    {
        $this->client->delete("rooms/{$roomId}", ['action_type' => $actionType->toString()]);
    }
}
