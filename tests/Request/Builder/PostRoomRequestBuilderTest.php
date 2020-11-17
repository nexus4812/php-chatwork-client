<?php

declare(strict_types=1);

namespace Nexus\ChatworkClient\Request\Builder;

use Carbon\Carbon;
use Carbon\CarbonImmutable;
use PHPUnit\Framework\TestCase;

class PostRoomRequestBuilderTest extends TestCase
{
    public function testBuilder(): void
    {
        $builder = new PostRoomBuilder();

        $builder->setName('John');
        $builder->setMembersReadonlyIds(1);

        $tomorrow = 1;
        CarbonImmutable::Today()->addDay()->isSameDay(Carbon::now());
        echo $tommorow;

        var_dump($builder);
    }
}
