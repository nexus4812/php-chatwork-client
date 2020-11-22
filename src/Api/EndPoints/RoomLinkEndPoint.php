<?php

declare(strict_types=1);

namespace Nexus\ChatworkClient\Api\EndPoints;

use Nexus\ChatworkClient\Client\ClientInterface;
use Nexus\ChatworkClient\Entities\Factories\LinkFactory;
use Nexus\ChatworkClient\Entities\Link;
use Nexus\ChatworkClient\Request\Builder\RoomLinkBuilder;

class RoomLinkEndPoint extends AbstractEndPoint
{
    /**
     * @var LinkFactory
     */
    protected $factory;

    /**
     * @var int
     */
    private $roomId;

    public function __construct(ClientInterface $client, LinkFactory $factory, int $roomId)
    {
        parent::__construct($client, $factory);
        $this->roomId = $roomId;
    }

    /**
     * GET /rooms/{room_id}/link 招待リンクを取得する.
     *
     * @see https://developer.chatwork.com/ja/endpoint_rooms.html#GET-rooms-room_id-link
     */
    public function getRoomLink(): Link
    {
        return $this->factory->entity(
            $this->client->get("rooms/{$this->roomId}/link")
        );
    }

    /**
     * POST /rooms/{room_id}/link 招待リンクを作成する.
     *
     * @see https://developer.chatwork.com/ja/endpoint_rooms.html#POST-rooms-room_id-link
     */
    public function postRoomLink(RoomLinkBuilder $builder): Link
    {
        return $this->factory->entity(
            $this->client->post("rooms/{$this->roomId}/link", $builder->build())
        );
    }

    /**
     * POST /rooms/{room_id}/link 招待リンクを作成する.
     *
     * @see https://developer.chatwork.com/ja/endpoint_rooms.html#POST-rooms-room_id-link
     */
    public function postRoomLinkWithRequired(): Link
    {
        return $this->factory->entity(
            $this->client->post("rooms/{$this->roomId}/link")
        );
    }

    /**
     * PUT /rooms/{room_id}/link 招待リンクの情報を変更する.
     *
     * @see https://developer.chatwork.com/ja/endpoint_rooms.html#PUT-rooms-room_id-link
     */
    public function putRoomLink(RoomLinkBuilder $builder): Link
    {
        return $this->factory->entity(
            $this->client->put("rooms/{$this->roomId}/link", $builder->build())
        );
    }

    /**
     * DELETE /rooms/{room_id}/link 招待リンクを削除する.
     *
     * @see https://developer.chatwork.com/ja/endpoint_rooms.html#DELETE-rooms-room_id-link
     */
    public function deleteRoomLink(): bool
    {
        return true === $this->client->delete("rooms/{$this->roomId}/link")['public'];
    }
}
