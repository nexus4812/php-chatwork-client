<?php

declare(strict_types=1);

namespace Nexus\ChatworkClient\Request\Builder;

use Nexus\ChatworkClient\Request\Enum\IconPreset;
use PHPUnit\Framework\TestCase;

class PutRoomRequestBuilderTest extends TestCase
{
    public function testBuilder(): void
    {
        $builder = new PutRoomBuilder();
        $array = $builder
            ->setName('John')
            ->setIconPreset(IconPreset::sport())
            ->setDescription('description')
            ->build();

        static::assertSame($array['name'], 'John');
        static::assertSame($array['icon_preset'], IconPreset::SPORTS);
        static::assertSame($array['description'], 'description');

        $builder = new PutRoomBuilder();
        static::assertSame($builder->build(), []);
    }
}
