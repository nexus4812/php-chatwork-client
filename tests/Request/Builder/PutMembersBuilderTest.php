<?php

declare(strict_types=1);

namespace Nexus\ChatworkClient\Request\Builder;

use PHPUnit\Framework\TestCase;

class PutMembersBuilderTest extends TestCase
{
    public function testSetId(): void
    {
        $builder = new PutMembersBuilder();
        $builder
            ->setAdminId(123, 542, 1001)
            ->setMemberId(21, 344)
            ->setReadonlyId(15, 103);

        $array = $builder->build();
        static::assertSame($array['members_admin_ids'], '123,542,1001');
        static::assertSame($array['members_member_ids'], '21,344');
        static::assertSame($array['members_readonly_ids'], '15,103');
    }

    public function testSetIds(): void
    {
        $builder = new PutMembersBuilder();
        $builder
            ->setAdminIds([123, 542, 1001])
            ->setMemberIds([21, 344])
            ->setReadonlyIds([15, 103]);

        $array = $builder->build();
        static::assertSame($array['members_admin_ids'], '123,542,1001');
        static::assertSame($array['members_member_ids'], '21,344');
        static::assertSame($array['members_readonly_ids'], '15,103');
    }

    public function testAssertAdminId(): void
    {
        $this->expectException(\LogicException::class);
        (new PutMembersBuilder())->setMemberId(111)->build();
    }
}
