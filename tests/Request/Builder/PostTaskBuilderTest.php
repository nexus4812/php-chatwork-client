<?php

declare(strict_types=1);

namespace Nexus\ChatworkClient\Request\Builder;

use Carbon\CarbonImmutable;
use Nexus\ChatworkClient\Request\Enum\TaskLimitType;
use PHPUnit\Framework\TestCase;

class PostTaskBuilderTest extends TestCase
{
    public function testBuilder(): void
    {
        $builder = new PostTaskBuilder();

        $builder
            ->setBody('Buy milk')
            ->setLimitByTimestamp(1385996399)
            ->setToIds([1, 3, 6])
            ->setLimitType(TaskLimitType::time());

        $array = $builder->build();

        static::assertSame($array['body'], 'Buy milk');
        static::assertSame($array['limit'], 1385996399);
        static::assertSame($array['limit_type'], 'time');
        static::assertSame($array['to_ids'], '1,3,6');
    }

    public function testCarbon(): void
    {
        $builder = new PostTaskBuilder();

        $builder
            ->setBody('Buy milk')
            ->setLimitByCarbon(CarbonImmutable::createFromTimestamp(1385996399))
            ->setToId(1, 3, 6);

        $array = $builder->build();

        static::assertSame($array['body'], 'Buy milk');
        static::assertSame($array['limit'], 1385996399);
        static::assertSame($array['to_ids'], '1,3,6');
    }

    public function testAssertBody(): void
    {
        $this->expectException(\LogicException::class);
        (new PostTaskBuilder())->setToIds([2])->build();
    }

    public function testAssertIds(): void
    {
        $this->expectException(\LogicException::class);
        (new PostTaskBuilder())->setBody('aaa')->build();
    }
}
