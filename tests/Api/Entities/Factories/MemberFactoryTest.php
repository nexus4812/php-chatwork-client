<?php

declare(strict_types=1);

namespace Nexus\ChatworkClient\Api\Entities\Factories;

use Nexus\ChatworkClient\Api\TestData\MemberResult;
use Nexus\ChatworkClient\Entities\Factories\MemberFactory;
use Nexus\ChatworkClient\Entities\Member;
use Nexus\ChatworkClient\Entities\PutMembers;
use PHPUnit\Framework\TestCase;

final class MemberFactoryTest extends TestCase
{
    use MemberResult;

    /**
     * @dataProvider providerGetEntity
     */
    public function testGetFactory(Member $entity): void
    {
        static::assertInstanceOf(Member::class, $entity);
        static::assertSame($entity->account_id, 123);
        static::assertSame($entity->role, 'member');
        static::assertSame($entity->name, 'John Smith');
        static::assertSame($entity->chatwork_id, 'tarochatworkid');
        static::assertSame($entity->organization_id, 101);
        static::assertSame($entity->organization_name, 'Hello Company');
        static::assertSame($entity->department, 'Marketing');
        static::assertSame($entity->avatar_image_url, 'https://example.com/abc.png');
    }

    /**
     * @dataProvider providerPutEntity
     */
    public function testPutFactory(PutMembers $entity): void
    {
        static::assertInstanceOf(PutMembers::class, $entity);

        static::assertSame($entity->admin[0], 123);
        static::assertSame($entity->admin[1], 542);
        static::assertSame($entity->admin[2], 1001);

        static::assertSame($entity->member[0], 10);
        static::assertSame($entity->member[1], 103);

        static::assertSame($entity->readonly[0], 6);
        static::assertSame($entity->readonly[1], 11);
    }

    public function providerGetEntity(): iterable
    {
        $factory = new MemberFactory();
        yield [$factory->entities($this->memberItemsGet())[0]];
        yield [$factory->entitiesAsCollection($this->memberItemsGet())->first()];
    }

    public function providerPutEntity(): iterable
    {
        $factory = new MemberFactory();
        yield [$factory->putEntity($this->memberItemPut())];
    }
}
