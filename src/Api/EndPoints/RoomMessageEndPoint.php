<?php

declare(strict_types=1);

namespace Nexus\ChatworkClient\Api\EndPoints;

use Illuminate\Support\Collection;
use Nexus\ChatworkClient\Client\ClientInterface;
use Nexus\ChatworkClient\Entities\Factories\MessageFactory;
use Nexus\ChatworkClient\Entities\Message;
use Nexus\ChatworkClient\Entities\PostMessages;
use Nexus\ChatworkClient\Entities\PutMessage;

class RoomMessageEndPoint extends AbstractEndPoint
{
    /**
     * @var MessageFactory
     */
    protected $factory;

    /**
     * @var int
     */
    private $roomId;

    public function __construct(ClientInterface $client, MessageFactory $factory, int $roomId)
    {
        parent::__construct($client, $factory);
        $this->roomId = $roomId;
    }

    /**
     * GET /rooms/{room_id}/messages チャットのメッセージ一覧を取得。パラメータ未指定だと前回取得分からの差分のみを返します。(最大100件まで取得).
     *
     * @return array<Message>|Collection
     */
    public function getRoomMessages(bool $force = false): Collection
    {
        return $this->factory->entitiesAsCollection(
            $this->client->get("/rooms/{$this->roomId}/messages", ['force' => $force ? 1 : 0])
        );
    }

    /**
     * POST /rooms/{room_id}/messages チャットに新しいメッセージを追加.
     */
    public function postRoomMessage(): PostMessages
    {
        return $this->factory->postEntity(
            $this->client->post("rooms/{$this->roomId}/messages")
        )->messageId;
    }

    /**
     * PUT /rooms/{room_id}/messages/readメッセージを既読にする.
     */
    public function putRoomMessageRead(int $messageId): PutMessage
    {
        return $this->factory->putEntity(
            $this->client->put("rooms/{$this->roomId}/messages/read", ['message_id' => $messageId])
        );
    }

    /**
     * PUT /rooms/{room_id}/messages/unread メッセージを未読にする.
     */
    public function putRoomMessageUnread(int $messageId): PutMessage
    {
        return $this->factory->putEntity(
            $this->client->put("rooms/{$this->roomId}/messages/unread", ['message_id' => $messageId])
        );
    }

    /**
     * GET /rooms/{room_id}/messages/{message_id} メッセージ情報を取得.
     */
    public function getRoomMessage(int $messageId): Message
    {
        return $this->factory->entity($this->client->get("rooms/{$this->roomId}/messages/{$messageId}"));
    }

    /**
     * PUT /rooms/{room_id}/messages/{message_id} チャットのメッセージを更新する。
     *
     * @return int message_id
     */
    public function putRoomMessage(int $messageId, string $body): int
    {
        return $this->client->put("rooms/{$this->roomId}/messages/{$messageId}", ['body' => $body])['message_id'];
    }

    /**
     * DELETE /rooms/{room_id}/messages/{message_id} メッセージを削除.
     */
    public function deleteRoomMessage(int $messageId): void
    {
        $this->client->delete("rooms/{$this->roomId}/messages/{$messageId}");
    }
}
