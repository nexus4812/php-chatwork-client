<?php

declare(strict_types=1);

namespace Nexus\ChatworkClient\Entities\Factories;

use Nexus\ChatworkClient\Request\Enum\ActionType;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 * @coversNothing
 */
final class ActionTypeTest extends TestCase
{
    private $keys;

    protected function setUp(): void
    {
        $this->keys = ['leave', 'delete'];
    }

    public function testIconPresent(): void
    {
        $this->assertKey(ActionType::leave()->toString());
        $this->assertKey(ActionType::delete()->toString());
    }

    private function assertKey(string $key): void
    {
        static::assertTrue(\in_array($key, $this->keys, true));
    }
}
