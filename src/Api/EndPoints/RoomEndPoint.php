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
     * @return Collection<Room>
     *
     * @see https://developer.chatwork.com/ja/endpoint_rooms.html#GET-rooms
     */
    public function getRooms(): Collection
    {
        return $this->factory->entitiesAsCollection($this->client->get('rooms'));
    }

    /**
     * POST /rooms グループチャットを新規作成.
     *
     * @return int room_id
     *
     * @see https://developer.chatwork.com/ja/endpoint_rooms.html#POST-rooms
     */
    public function postRoomByBuilder(PostRoomBuilder $builder): int
    {
        return $this->client->post('rooms', $builder->build())['room_id'];
    }

    /**
     * GET /rooms/{room_id} チャットの名前、アイコン、種類(my/direct/group)を取得.
     *
     * @see https://developer.chatwork.com/ja/endpoint_rooms.html#GET-rooms-room_id
     */
    public function getRoom(int $roomId): Room
    {
        return $this->factory->entity(
            $this->client->get("rooms/{$roomId}")
        );
    }

    /**
     * PUT /rooms/{room_id} チャットの名前、アイコンをアップデート.
     *
     * @see https://developer.chatwork.com/ja/endpoint_rooms.html#PUT-rooms-room_id
     */
    public function putRoomByBuilder(int $roomId, PutRoomBuilder $builder): int
    {
        return $this->client->put("rooms/{$roomId}", $builder->build())['room_id'];
    }

    /**
     * DELETE /rooms/{room_id} グループチャットを退席/削除する.
     *
     * @see https://developer.chatwork.com/ja/endpoint_rooms.html#DELETE-rooms-room_id
     */
    public function deleteRoom(int $roomId, ActionType $actionType): void
    {
        $this->client->delete("rooms/{$roomId}", ['action_type' => $actionType->toString()]);
    }
}
