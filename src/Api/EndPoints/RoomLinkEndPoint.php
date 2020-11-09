<?php

declare(strict_types=1);

namespace Nexus\ChatworkClient\Api\EndPoints;

use Nexus\ChatworkClient\Client\ClientInterface;
use Nexus\ChatworkClient\Entities\Factories\LinkFactory;
use Nexus\ChatworkClient\Entities\Link;

class RoomLinkEndPoint extends AbstractEndPoint
{
    /**
     * @var LinkFactory
     */
    private $linkFactory;

    private $roomId;

    public function __construct(
        ClientInterface $client,
        LinkFactory $linkFactory,
        int $roomId
    ) {
        parent::__construct($client);
        $this->linkFactory = $linkFactory;
        $this->roomId = $roomId;
    }

    /**
     * GET /rooms/{room_id}/link招待リンクを取得する.
     */
    public function getRoomLink(): Link
    {
        return $this->linkFactory->entity($this->client->post("rooms/{$this->roomId}/link"));
    }

    /**
     * POST /rooms/{room_id}/link招待リンクを作成する.
     */
    public function postRoomLink(string $code = '', string $description = '', bool $needAcceptance = false): Link
    {
        return $this->linkFactory->entity($this->client->post("/rooms/{$this->roomId}/link", [
            'code' => $code,
            'description' => $description,
            'need_acceptance' => $needAcceptance ? '1' : '0',
        ]));
    }

    /**
     * PUT /rooms/{room_id}/link招待リンクの情報を変更する.
     */
    public function putRoomLink(string $code = '', string $description = '', bool $needAcceptance = false): Link
    {
        return $this->linkFactory->entity($this->client->put("/rooms/{$this->roomId}/link", [
            'code' => $code,
            'description' => $description,
            'need_acceptance' => $needAcceptance ? '1' : '0',
        ]));
    }

    public function deleteRoomLink(): bool
    {
        return true === $this->client->delete("rooms/{$this->roomId}/link")['public'];
    }
}
