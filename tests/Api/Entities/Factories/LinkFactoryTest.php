<?php

declare(strict_types=1);

namespace Nexus\ChatworkClient\Entities\Factories;

use Nexus\ChatworkClient\Api\TestData\LinkResult;
use Nexus\ChatworkClient\Entities\Link;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 * @coversNothing
 */
final class LinkFactoryTest extends TestCase
{
    use LinkResult;

    /**
     * @dataProvider providerGetEntity
     */
    public function testGetEntity(Link $entity): void
    {
        static::assertInstanceOf(Link::class, $entity);
        static::assertSame($entity->public, true);
        static::assertSame($entity->url, 'https://example.chatwork.com/g/randomcode42');
        static::assertSame($entity->need_acceptance, true);
        static::assertSame($entity->description, 'Link description text');
    }

    public function providerGetEntity(): iterable
    {
        $factory = new LinkFactory();
        yield [$factory->entity($this->linkItemGet())];
    }
}
