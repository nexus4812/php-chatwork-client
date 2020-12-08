<?php

declare(strict_types=1);

namespace Nexus\ChatworkClient\Api\EndPoints;

use Illuminate\Support\Collection;
use Nexus\ChatworkClient\Client\ClientInterface;
use Nexus\ChatworkClient\Entities\Factories\FileFactory;
use Nexus\ChatworkClient\Entities\File;
use Nexus\ChatworkClient\Exception\FileNotReadException;

class RoomFileEndPoint extends AbstractEndPoint
{
    /**
     * @var FileFactory
     */
    protected $factory;

    /**
     * @var int
     */
    private $roomId;

    public function __construct(ClientInterface $client, FileFactory $factory, int $roomId)
    {
        parent::__construct($client, $factory);
        $this->roomId = $roomId;
    }

    /**
     * GET /rooms/{room_id}/filesチャットのファイル一覧を取得 (※100件まで取得可能。今後、より多くのデータを取得する為のページネーションの仕組みを提供予定).
     *
     * @return array<File>|Collection
     *
     * @see https://developer.chatwork.com/ja/endpoint_rooms.html#GET-rooms-room_id-files
     */
    public function getRoomFiles(?int $accountId = null): Collection
    {
        return $this->factory->entitiesAsCollection(
            $this->client->get("rooms/{$this->roomId}/files", $accountId ? ['account_id' => $accountId] : [])
        );
    }

    /**
     * POST /rooms/{room_id}/filesチャットに新しいファイルをアップロード.
     *
     * @return int file_id
     *
     * @see https://developer.chatwork.com/ja/endpoint_rooms.html#POST-rooms-room_id-files
     */
    public function postRoomFile(string $filePath, ?string $message = null): int
    {
        $resource = fopen($filePath, 'r');
        if (false === $resource) {
            throw new FileNotReadException("Failed to read file '{$filePath}'");
        }

        return $this->client->postMultipart("rooms/{$this->roomId}/files", [
            'file' => $resource,
            'message' => $message,
        ])['file_id'];
    }

    /**
     * GET /rooms/{room_id}/files/{file_id}ファイル情報を取得.
     *
     * @see https://developer.chatwork.com/ja/endpoint_rooms.html#GET-rooms-room_id-files-file_id
     */
    public function getRoomFile(int $fileId, bool $createDownloadUrl = false): File
    {
        return $this->factory->entity(
            $this->client->get("rooms/{$this->roomId}/files/{$fileId}", [
                'create_download_url' => $createDownloadUrl ? '1' : '0',
            ])
        );
    }
}
