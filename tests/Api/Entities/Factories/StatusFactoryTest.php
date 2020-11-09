<?php

declare(strict_types=1);

namespace Nexus\ChatworkClient\Entities\Factories;

use Nexus\ChatworkClient\Entities\Status;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 * @coversNothing
 */
final class StatusFactoryTest extends TestCase
{
    /**
     * @dataProvider providerEntity
     */
    public function testFactory(Status $entity): void
    {
        static::assertInstanceOf(Status::class, $entity);
        static::assertSame($entity->unread_room_num, 2);
        static::assertSame($entity->mention_room_num, 1);
        static::assertSame($entity->mytask_room_num, 3);
        static::assertSame($entity->unread_num, 12);
        static::assertSame($entity->mention_num, 1);
        static::assertSame($entity->mytask_num, 8);
    }

    public function providerEntity(): iterable
    {
        $factory = new StatusFactory();
        $r = json_decode('
          {
  "unread_room_num": 2,
  "mention_room_num": 1,
  "mytask_room_num": 3,
  "unread_num": 12,
  "mention_num": 1,
  "mytask_num": 8
  }', true);
        yield [$factory->entity($r)];
    }
}
