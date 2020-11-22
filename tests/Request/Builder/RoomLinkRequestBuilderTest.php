<?php

declare(strict_types=1);

namespace Nexus\ChatworkClient\Request\Builder;

use PHPUnit\Framework\TestCase;

class RoomLinkRequestBuilderTest extends TestCase
{
    public function testBuilder(): void
    {
        $builder = new RoomLinkBuilder();
        $array = $builder
            ->setNeedAcceptance(false)
            ->setCode('unique-link-name')
            ->setDescription('This is a public room for topic A.')
            ->build();

        static::assertSame($array['code'], 'unique-link-name');
        static::assertSame($array['description'], 'This is a public room for topic A.');
        static::assertSame($array['need_acceptance'], 0);

        static ::assertSame([], (new RoomLinkBuilder())->build());
    }
}
