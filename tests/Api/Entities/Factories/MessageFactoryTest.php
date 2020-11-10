<?php

declare(strict_types=1);

namespace Nexus\ChatworkClient\Entities\Factories;

use Nexus\ChatworkClient\Entities\Account;
use Nexus\ChatworkClient\Entities\Message;
use Nexus\ChatworkClient\Entities\PutMessage;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 * @coversNothing
 */
final class MessageFactoryTest extends TestCase
{
    /**
     * @dataProvider providerGetEntity
     */
    public function testGetEntity(Message $entity): void
    {
        static::assertInstanceOf(Message::class, $entity);

        static::assertSame($entity->message_id, '5');

        static::assertInstanceOf(Account::class, $entity->account);
        static::assertSame($entity->account->account_id, 123);
        static::assertSame($entity->account->name, 'Bob');
        static::assertSame($entity->account->avatar_image_url, 'https://example.com/ico_avatar.png');

        static::assertSame($entity->body, 'Hello Chatwork!');
        static::assertSame($entity->send_time, 1384242850);
        static::assertSame($entity->update_time, 0);
    }

    /**
     * @dataProvider providerPutEntity
     */
    public function testPutEntity(PutMessage $entity): void
    {
        static::assertInstanceOf(PutMessage::class, $entity);
        static::assertSame($entity->unread_num, 461);
        static::assertSame($entity->mention_num, 0);
    }

    public function providerPutEntity(): iterable
    {
        $factory = new MessageFactory();
        $r = json_decode('
{
  "unread_num": 461,
  "mention_num": 0
}', true);
        yield [$factory->putEntity($r)];
    }

    public function providerGetEntity(): iterable
    {
        $factory = new MessageFactory();
        $r = json_decode('
{
  "message_id": "5",
  "account": {
    "account_id": 123,
    "name": "Bob",
    "avatar_image_url": "https://example.com/ico_avatar.png"
  },
  "body": "Hello Chatwork!",
  "send_time": 1384242850,
  "update_time": 0
}', true);
        yield [$factory->entity($r)];

        $items = json_decode('
[
  {
    "message_id": "5",
    "account": {
      "account_id": 123,
      "name": "Bob",
      "avatar_image_url": "https://example.com/ico_avatar.png"
    },
    "body": "Hello Chatwork!",
    "send_time": 1384242850,
    "update_time": 0
  }
]', true);
        yield [$factory->entities($items)[0]];
        yield [$factory->entitiesAsCollection($items)->first()];
    }
}
