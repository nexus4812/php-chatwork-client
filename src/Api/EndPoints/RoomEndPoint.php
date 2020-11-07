<?php

declare(strict_types=1);

namespace ChatWorkClient\Api\EndPoints;

use ChatWorkClient\Client\ClientInterface;
use ChatWorkClient\Entities\Factories\FileFactory;
use ChatWorkClient\Entities\Factories\LinkFactory;
use ChatWorkClient\Entities\Factories\MemberFactory;
use ChatWorkClient\Entities\Factories\MessageFactory;
use ChatWorkClient\Entities\Factories\PostTask;
use ChatWorkClient\Entities\Factories\RoomFactory;
use ChatWorkClient\Entities\Factories\TaskFactory;
use ChatWorkClient\Entities\File;
use ChatWorkClient\Entities\Link;
use ChatWorkClient\Entities\Member;
use ChatWorkClient\Entities\Message;
use ChatWorkClient\Entities\PostMessages;
use ChatWorkClient\Entities\PutMembers;
use ChatWorkClient\Entities\PutMessage;
use ChatWorkClient\Entities\Room;
use ChatWorkClient\Entities\Task;
use Illuminate\Support\Collection;

class RoomEndPoint extends AbstractEndPoint
{
    /**
     * @var RoomFactory
     */
    private $roomFactory;

    /**
     * @var MemberFactory
     */
    private $memberFactory;

    /**
     * @var MessageFactory
     */
    private $messageFactory;

    /**
     * @var TaskFactory
     */
    private $taskFactory;

    /**
     * @var LinkFactory
     */
    private $linkFactory;

    /**
     * @var FileFactory
     */
    private $fileFactory;

    public function __construct(
        ClientInterface $client,
        RoomFactory $roomFactory,
        MemberFactory $memberFactory,
        MessageFactory $messageFactory,
        TaskFactory $taskFactory,
        LinkFactory $linkFactory,
        FileFactory $fileFactory
    ) {
        parent::__construct($client);
        $this->roomFactory = $roomFactory;
        $this->memberFactory = $memberFactory;
        $this->messageFactory = $messageFactory;
        $this->taskFactory = $taskFactory;
        $this->linkFactory = $linkFactory;
        $this->fileFactory = $fileFactory;
    }

    /**
     * GET /rooms 自分のチャット一覧の取得.
     *
     * @return array<Room>
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
    public function getRoom(int $roomId): Room
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

    /**
     * GET /rooms/{room_id}/members チャットのメンバー一覧を取得.
     *
     * @return array<Member>
     */
    public function getRoomMembers(int $roomId): array
    {
        return $this->memberFactory->entities($this->client->get("room/{$roomId}/members"));
    }

    /**
     * PUT /rooms/{room_id}/members チャットのメンバーを一括変更.
     *
     * @param array<int> $membersAdminIds
     * @param array<int> $membersMemberIds
     * @param array<int> $membersReadonlyIds
     */
    public function putRoomMembers(
        int $roomId,
        array $membersAdminIds,
        array $membersMemberIds = [],
        array $membersReadonlyIds = []
    ): PutMembers {
        return $this->memberFactory->putEntity($this->client->put("rooms/{$roomId}/members", [
            'members_admin_ids' => $membersAdminIds,
            'members_member_ids' => $membersMemberIds,
            'members_readonly_ids' => $membersReadonlyIds,
        ]));
    }

    /**
     * GET /rooms/{room_id}/messages チャットのメッセージ一覧を取得。パラメータ未指定だと前回取得分からの差分のみを返します。(最大100件まで取得).
     *
     * @return array<Message>
     */
    public function getRoomMessages(int $roomId, bool $force = false): array
    {
        return $this->messageFactory->entities($this->client->get("/rooms/{$roomId}/messages", ['force' => $force ? 1 : 0]));
    }

    public function getRoomMessagesAsCollection(int $roomId, bool $force = false): Collection
    {
        return $this->arrayToCollection($this->getRoomMessages($roomId, $force));
    }

    /**
     * POST /rooms/{room_id}/messages チャットに新しいメッセージを追加.
     */
    public function postRoomMessage(int $roomId): PostMessages
    {
        return $this->messageFactory->postEntity($this->client->post("rooms/{$roomId}/messages"))->messageId;
    }

    /**
     * PUT /rooms/{room_id}/messages/readメッセージを既読にする.
     */
    public function putRoomMessageRead(int $roomId, int $messageId): PutMessage
    {
        return $this->messageFactory->putEntity($this->client->put("rooms/{$roomId}/messages/read", [
            'message_id' => $messageId,
        ]));
    }

    /**
     * PUT /rooms/{room_id}/messages/unread メッセージを未読にする.
     */
    public function putRoomMessageUnread(int $roomId, int $messageId): PutMessage
    {
        return $this->messageFactory->putEntity($this->client->put("rooms/{$roomId}/messages/unread", [
            'message_id' => $messageId,
        ]));
    }

    /**
     * GET /rooms/{room_id}/messages/{message_id} メッセージ情報を取得.
     */
    public function getRoomMessage(int $roomId, int $messageId): Message
    {
        return $this->messageFactory->entity($this->client->get("rooms/{$roomId}/messages/{$messageId}"));
    }

    /**
     * PUT /rooms/{room_id}/messages/{message_id} チャットのメッセージを更新する。
     *
     * @return int message_id
     */
    public function putRoomMessage(int $roomId, int $messageId, string $body): int
    {
        return $this->client->put("rooms/{$roomId}/messages/{$messageId}", ['body' => $body])['message_id'];
    }

    /**
     * DELETE /rooms/{room_id}/messages/{message_id} メッセージを削除.
     */
    public function deleteRoomMessage(int $roomId, int $messageId): void
    {
        $this->client->delete("rooms/{$roomId}/messages/{$messageId}");
    }

    /**
     * GET /rooms/{room_id}/tasksチャットのタスク一覧を取得 (※100件まで取得可能。今後、より多くのデータを取得する為のページネーションの仕組みを提供予定).
     *
     * @return array<Task>
     */
    public function getRoomTasks(int $roomId): array
    {
        return $this->taskFactory->entities($this->client->get("rooms/{$roomId}/tasks"));
    }

    public function getRoomTasksAsCollection(int $roomId): Collection
    {
        return $this->arrayToCollection($this->getRoomTasks($roomId));
    }

    /**
     * POST /rooms/{room_id}/tasksチャットに新しいタスクを追加.
     *
     * @param array<int> $toIds
     * @param string     $limitType [open, done]
     */
    public function postRoomsTasks(int $roomId, string $body, array $toIds, string $limit = '', string $limitType = ''): PostTask
    {
        return $this->taskFactory->postEntity($this->client->post("rooms/{$roomId}/tasks", [
            'body' => $body,
            'limit' => $limit,
            'limit_type' => $limitType,
            'toIds' => implode(',', $toIds),
        ]));
    }

    /**
     * GET /rooms/{room_id}/tasks/{task_id}タスク情報を取得.
     */
    public function getRoomTask(int $roomId, int $taskId): Task
    {
        return $this->taskFactory->entity($this->client->get("rooms/{$roomId}/tasks{$taskId}"));
    }

    /**
     * PUT /rooms/{room_id}/tasks/{task_id}/statusタスク完了状態を変更する.
     *
     * @param string $body open, done
     */
    public function putRoomTask(int $roomId, int $taskId, string $body): int
    {
        return $this->client->put("rooms/{$roomId}/tasks/{$taskId}/status", [
            'body' => $body,
        ])['task_id'];
    }

    /**
     * GET /rooms/{room_id}/filesチャットのファイル一覧を取得 (※100件まで取得可能。今後、より多くのデータを取得する為のページネーションの仕組みを提供予定).
     *
     * @return array<File>
     */
    public function getRoomFiles(int $roomId, int $accountId = 0): array
    {
        return $this->fileFactory->entities(
            $this->client->get("rooms/{$roomId}/files", [
                'account_id' => 0 !== $accountId ? $accountId : 0,
            ])
        );
    }

    /**
     * POST /rooms/{room_id}/filesチャットに新しいファイルをアップロード.
     */
    public function postRoomFile(): void
    {
        // TODO create
    }

    /**
     * GET /rooms/{room_id}/files/{file_id}ファイル情報を取得.
     */
    public function getRoomFile(int $roomId, int $fileId, bool $createDownloadUrl = false): File
    {
        return $this->fileFactory->entity(
            $this->client->get("rooms/{$roomId}/files/{$fileId}", [
                'create_download_url' => true === $createDownloadUrl ? 1 : 0,
            ])
        );
    }

    /**
     * GET /rooms/{room_id}/link招待リンクを取得する.
     */
    public function getRoomLink(int $roomId): Link
    {
        return $this->linkFactory->entity($this->client->post("rooms/{$roomId}/link"));
    }

    /**
     * POST /rooms/{room_id}/link招待リンクを作成する.
     */
    public function postRoomLink(int $roomId, string $code = '', string $description = '', bool $needAcceptance = false): Link
    {
        return $this->linkFactory->entity($this->client->post("/rooms/{$roomId}/link", [
            'code' => $code,
            'description' => $description,
            'need_acceptance' => $needAcceptance ? '1' : '0',
        ]));
    }

    /**
     * PUT /rooms/{room_id}/link招待リンクの情報を変更する.
     */
    public function putRoomLink(int $roomId, string $code = '', string $description = '', bool $needAcceptance = false): Link
    {
        return $this->linkFactory->entity($this->client->put("/rooms/{$roomId}/link", [
            'code' => $code,
            'description' => $description,
            'need_acceptance' => $needAcceptance ? '1' : '0',
        ]));
    }

    public function deleteRoomLink(int $roomId): bool
    {
        return 'true' === $this->client->delete("rooms/{$roomId}/link")['public'];
    }
}
