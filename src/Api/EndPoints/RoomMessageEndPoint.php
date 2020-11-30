<?php

declare(strict_types=1);

namespace Nexus\ChatworkClient\Api\EndPoints;

use Illuminate\Support\Collection;
use Nexus\ChatworkClient\Client\ClientInterface;
use Nexus\ChatworkClient\Entities\Factories\MessageFactory;
use Nexus\ChatworkClient\Entities\Message;
use Nexus\ChatworkClient\Entities\PutReadMessage;

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
     *
     * @see https://developer.chatwork.com/ja/endpoint_rooms.html#GET-rooms-room_id-messages
     */
    public function getRoomMessages(bool $force = false): Collection
    {
        return $this->factory->entitiesAsCollection(
            $this->client->get("rooms/{$this->roomId}/messages", ['force' => $force ? '1' : '0'])
        );
    }

    /**
     * POST /rooms/{room_id}/messages チャットに新しいメッセージを追加.
     *
     * @return string message_id
     *
     * @see https://developer.chatwork.com/ja/endpoint_rooms.html#POST-rooms-room_id-messages
     */
    public function postRoomMessage(string $body, bool $selfUnread = false): string
    {
        return $this->client->post("rooms/{$this->roomId}/messages", [
            'body' => $body,
            'self_unread' => $selfUnread ? '1' : '0',
        ])['message_id'];
    }

    /**
     * PUT /rooms/{room_id}/messages/readメッセージを既読にする.
     *
     * @see https://developer.chatwork.com/ja/endpoint_rooms.html#PUT-rooms-room_id-messages-read
     */
    public function putRoomMessageRead(int $messageId): PutReadMessage
    {
        return $this->factory->putEntity(
            $this->client->put("rooms/{$this->roomId}/messages/read", ['message_id' => $messageId])
        );
    }

    /**
     * PUT /rooms/{room_id}/messages/unread メッセージを未読にする.
     *
     * @see https://developer.chatwork.com/ja/endpoint_rooms.html#PUT-rooms-room_id-messages-unread
     */
    public function putRoomMessageUnread(int $messageId): PutReadMessage
    {
        return $this->factory->putEntity(
            $this->client->put("rooms/{$this->roomId}/messages/unread", ['message_id' => $messageId])
        );
    }

    /**
     * GET /rooms/{room_id}/messages/{message_id} メッセージ情報を取得.
     *
     * @see https://developer.chatwork.com/ja/endpoint_rooms.html#GET-rooms-room_id-messages
     */
    public function getRoomMessage(int $messageId): Message
    {
        return $this->factory->entity(
            $this->client->get("rooms/{$this->roomId}/messages/{$messageId}")
        );
    }

    /**
     * PUT /rooms/{room_id}/messages/{message_id} チャットのメッセージを更新する。
     *
     * @return int message_id
     *
     * @see https://developer.chatwork.com/ja/endpoint_rooms.html#PUT-rooms-room_id-messages-message_id
     */
    public function putRoomMessage(int $messageId, string $body): string
    {
        return $this->client->put("rooms/{$this->roomId}/messages/{$messageId}", ['body' => $body])['message_id'];
    }

    /**
     * DELETE /rooms/{room_id}/messages/{message_id} メッセージを削除.
     *
     * @see https://developer.chatwork.com/ja/endpoint_rooms.html#DELETE-rooms-room_id-messages-message_id
     */
    public function deleteRoomMessage(int $messageId): string
    {
        return $this->client->delete("rooms/{$this->roomId}/messages/{$messageId}")['message_id'];
    }
}
