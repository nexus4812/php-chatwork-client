<?php

declare(strict_types=1);

namespace Nexus\ChatworkClient\Request\Builder;

use Nexus\ChatworkClient\Request\Enum\IconPreset;
use PHPUnit\Framework\TestCase;

class PostRoomRequestBuilderTest extends TestCase
{
    public function testBuilder(): void
    {
        $builder = new PostRoomBuilder();
        $array = $builder
            ->setName('John')
            ->setMembersReadonlyIds([1, 22, 333])
            ->setMembersMemberIds([444, 555, 666])
            ->setMembersAdminIds([77, 88, 99])
            ->setLinkNeedAcceptance(true)
            ->setLinkCode('link_code_test')
            ->setIconPreset(IconPreset::sport())
            ->setDescription('description')
            ->build();

        static::assertSame($array['name'], 'John');
        static::assertSame($array['members_readonly_ids'], '1,22,333');
        static::assertSame($array['members_member_ids'], '444,555,666');
        static::assertSame($array['members_admin_ids'], '77,88,99');

        static::assertSame($array['link_need_acceptance'], true);
        static::assertSame($array['link_code'], 'link_code_test');
        static::assertSame($array['icon_preset'], IconPreset::SPORTS);
        static::assertSame($array['description'], 'description');
    }

    public function testAssertRoom(): void
    {
        $this->expectException(\LogicException::class);
        (new PostRoomBuilder())->setMembersAdminIds([2])->build();
    }

    public function testAdminIdsRoom(): void
    {
        $this->expectException(\LogicException::class);
        (new PostRoomBuilder())->setName('aaa')->build();
    }
}
