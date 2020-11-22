<?php

declare(strict_types=1);

namespace Nexus\ChatworkClient\Request\Decorator;

use PHPUnit\Framework\TestCase;

class MessageDecoratorTest extends TestCase
{
    public function test(): void
    {
        static::assertSame(
            '[To:350108]',
            MessageDecorator::to(350108)
        );

        static::assertSame(
            '[rp aid=350108 to=23235169-1381557818980585472]',
            MessageDecorator::reply(350108, 23235169, 1381557818980585472)
        );

        static::assertSame(
            '[info]...[/info]',
            MessageDecorator::info('...')
        );

        static::assertSame(
            '[title]...[/title]',
            MessageDecorator::title('...')
        );

        static::assertSame(
            '[info][title]...title[/title]...info[/info]',
            MessageDecorator::informationTitle('...title', '...info')
        );

        static::assertSame(
            '[picon:350108]',
            MessageDecorator::profileIcon(350108)
        );

        static::assertSame(
            '[piconname:350108]',
            MessageDecorator::profileIconName(350108)
        );
    }
}
