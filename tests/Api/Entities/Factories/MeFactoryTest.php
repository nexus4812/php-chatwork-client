<?php

declare(strict_types=1);

namespace Nexus\ChatworkClient\Entities\Factories;

use Nexus\ChatworkClient\Entities\Me;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 * @coversNothing
 */
final class MeFactoryTest extends TestCase
{
    /**
     * @dataProvider providerEntity
     */
    public function testGetFactory(Me $entity): void
    {
        static::assertInstanceOf(Me::class, $entity);
        static::assertSame($entity->account_id, 123);
        static::assertSame($entity->room_id, 322);
        static::assertSame($entity->name, 'John Smith');
        static::assertSame($entity->chatwork_id, 'tarochatworkid');
        static::assertSame($entity->organization_id, 101);
        static::assertSame($entity->organization_name, 'Hello Company');
        static::assertSame($entity->department, 'Marketing');
        static::assertSame($entity->title, 'CMO');
        static::assertSame($entity->url, 'http://mycompany.example.com');
        static::assertSame($entity->introduction, 'Self Introduction');
        static::assertSame($entity->mail, 'taro@example.com');
        static::assertSame($entity->tel_organization, 'XXX-XXXX-XXXX');
        static::assertSame($entity->tel_extension, 'YYY-YYYY-YYYY');
        static::assertSame($entity->tel_mobile, 'ZZZ-ZZZZ-ZZZZ');
        static::assertSame($entity->skype, 'myskype_id');
        static::assertSame($entity->facebook, 'myfacebook_id');
        static::assertSame($entity->twitter, 'mytwitter_id');
        static::assertSame($entity->avatar_image_url, 'https://example.com/abc.png');
        static::assertSame($entity->login_mail, 'account@example.com');
    }

    public function providerEntity(): iterable
    {
        $factory = new MeFactory();
        $r = json_decode('
         {
  "account_id": 123,
  "room_id": 322,
  "name": "John Smith",
  "chatwork_id": "tarochatworkid",
  "organization_id": 101,
  "organization_name": "Hello Company",
  "department": "Marketing",
  "title": "CMO",
  "url": "http://mycompany.example.com",
  "introduction": "Self Introduction",
  "mail": "taro@example.com",
  "tel_organization": "XXX-XXXX-XXXX",
  "tel_extension": "YYY-YYYY-YYYY",
  "tel_mobile": "ZZZ-ZZZZ-ZZZZ",
  "skype": "myskype_id",
  "facebook": "myfacebook_id",
  "twitter": "mytwitter_id",
  "avatar_image_url": "https://example.com/abc.png",
  "login_mail": "account@example.com"
}', true);
        yield [$factory->entity($r)];
    }
}
