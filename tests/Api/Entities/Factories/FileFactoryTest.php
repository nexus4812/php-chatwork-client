<?php

declare(strict_types=1);

namespace Nexus\ChatworkClient\Entities\Factories;

use Nexus\ChatworkClient\Entities\Account;
use Nexus\ChatworkClient\Entities\File;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 * @coversNothing
 */
final class FileFactoryTest extends TestCase
{
    /**
     * @dataProvider providerGetEntity
     */
    public function testGetEntity(File $entity): void
    {
        static::assertInstanceOf(File::class, $entity);

        static::assertSame($entity->file_id, 3);

        static::assertInstanceOf(Account::class, $entity->account);
        static::assertSame($entity->account->account_id, 123);
        static::assertSame($entity->account->name, 'Bob');
        static::assertSame($entity->account->avatar_image_url, 'https://example.com/ico_avatar.png');

        static::assertSame($entity->message_id, '22');
        static::assertSame($entity->filename, 'README.md');
        static::assertSame($entity->filesize, 2232);
        static::assertSame($entity->upload_time, 1384414750);
    }

    public function providerGetEntity(): iterable
    {
        $factory = new FileFactory();
        $r = json_decode('
{
  "file_id":3,
  "account": {
    "account_id":123,
    "name":"Bob",
    "avatar_image_url": "https://example.com/ico_avatar.png"
  },
  "message_id": "22",
  "filename": "README.md",
  "filesize": 2232,
  "upload_time": 1384414750
}', true);
        yield [$factory->entity($r)];

        $items = json_decode('
[
  {
    "file_id": 3,
    "account": {
      "account_id": 123,
      "name": "Bob",
      "avatar_image_url": "https://example.com/ico_avatar.png"
    },
    "message_id": "22",
    "filename": "README.md",
    "filesize": 2232,
    "upload_time": 1384414750
  }
]', true);
        yield [$factory->entities($items)[0]];
        yield [$factory->entitiesAsCollection($items)->first()];
    }
}
