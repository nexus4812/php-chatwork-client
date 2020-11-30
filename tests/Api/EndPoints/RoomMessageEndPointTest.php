<?php

declare(strict_types=1);

namespace Nexus\ChatworkClient\Api\EndPoints;

use Nexus\ChatworkClient\Api\TestData\MessageResult;
use Nexus\ChatworkClient\Client\ClientInterface;
use Nexus\ChatworkClient\Entities\Factories\MessageFactory;
use Nexus\ChatworkClient\Entities\Message;
use Nexus\ChatworkClient\Entities\PutReadMessage;
use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;

/**
 * @internal
 * @coversNothing
 */
final class RoomMessageEndPointTest extends TestCase
{
    use ProphecyTrait;
    use MessageResult;

    public function testGet(): void
    {
        $roomId = 123;
        $messageId = 5;
        $clientProphecy = $this->prophesize(ClientInterface::class);

        $clientProphecy->get("rooms/{$roomId}/messages", ['force' => '0'])->willReturn($this->messageItemsGet());
        $clientProphecy->get("rooms/{$roomId}/messages/{$messageId}")->willReturn($this->messageItemGet());

        $endPoint = new RoomMessageEndPoint($clientProphecy->reveal(), new MessageFactory(), $roomId);
        static::assertInstanceOf(Message::class, $endPoint->getRoomMessages(false)->first());
        static::assertInstanceOf(Message::class, $endPoint->getRoomMessage($messageId));
    }

    public function testPost(): void
    {
        $roomId = 123;
        $clientProphecy = $this->prophesize(ClientInterface::class);
        $clientProphecy->post("rooms/{$roomId}/messages", ['body' => 'Hello Chatwork!!', 'self_unread' => '0'])->willReturn($this->messageItemPost());

        $endPoint = new RoomMessageEndPoint($clientProphecy->reveal(), new MessageFactory(), $roomId);
        static::assertSame('1234', $endPoint->postRoomMessage('Hello Chatwork!!', false));
    }

    public function testPutRead(): void
    {
        $roomId = 123;
        $messageId = 456;
        $clientProphecy = $this->prophesize(ClientInterface::class);
        $clientProphecy->put("rooms/{$roomId}/messages/read", ['message_id' => $messageId])->willReturn($this->messageItemPutRead());
        $clientProphecy->put("rooms/{$roomId}/messages/unread", ['message_id' => $messageId])->willReturn($this->messageItemPutRead());

        $endPoint = new RoomMessageEndPoint($clientProphecy->reveal(), new MessageFactory(), $roomId);
        static::assertInstanceOf(PutReadMessage::class, $endPoint->putRoomMessageRead($messageId));
        static::assertInstanceOf(PutReadMessage::class, $endPoint->putRoomMessageUnread($messageId));
    }

    public function testPut(): void
    {
        $roomId = 123;
        $messageId = 456;
        $clientProphecy = $this->prophesize(ClientInterface::class);
        $clientProphecy->put("rooms/{$roomId}/messages/{$messageId}", ['body' => 'Hello Chatwork!'])->willReturn($this->messageItemPut());

        $endPoint = new RoomMessageEndPoint($clientProphecy->reveal(), new MessageFactory(), $roomId);
        static::assertSame('1234', $endPoint->putRoomMessage($messageId, 'Hello Chatwork!'));
    }

    public function testDeleteMessage(): void
    {
        $roomId = 123;
        $messageId = 456;
        $clientProphecy = $this->prophesize(ClientInterface::class);
        $clientProphecy->delete("rooms/{$roomId}/messages/{$messageId}")->willReturn($this->messageItemDelete());

        $endPoint = new RoomMessageEndPoint($clientProphecy->reveal(), new MessageFactory(), $roomId);
        static::assertSame('1234', $endPoint->deleteRoomMessage($messageId));
    }
}
