<?php

declare(strict_types=1);

namespace Nexus\ChatworkClient\Api\EndPoints;

use Nexus\ChatworkClient\Api\TestData\FileResult;
use Nexus\ChatworkClient\Client\ClientInterface;
use Nexus\ChatworkClient\Entities\Factories\FileFactory;
use Nexus\ChatworkClient\Entities\File;
use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;

class RoomFileEndPointTest extends TestCase
{
    use ProphecyTrait;
    use FileResult;

    public function testGetRoomFiles(): void
    {
        $roomId = 1234;
        $accountId = 5678;
        $fileId = 91011;

        $clientProphecy = $this->prophesize(ClientInterface::class);
        $query = ['account_id' => $accountId];

        $clientProphecy->get("rooms/{$roomId}/files", $query)->willReturn($this->fileItemsGet());
        $clientProphecy->get("rooms/{$roomId}/files/{$fileId}", ['create_download_url' => '0'])->willReturn($this->fileItemGet());
        $endPoint = new RoomFileEndPoint($clientProphecy->reveal(), new FileFactory(), $roomId);

        static::assertInstanceOf(File::class, $endPoint->getRoomFiles($accountId)->first());
        static::assertInstanceOf(File::class, $endPoint->getRoomFile($fileId));
    }

    /**
     * @doesNotPerformAssertions
     */
    public function testPostRoomFile(): void
    {
        // TODO create test
    }
}
