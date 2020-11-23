<?php

declare(strict_types=1);

namespace Nexus\ChatworkClient\Entities\Factories;

use Nexus\ChatworkClient\Request\Enum\TaskLimitType;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 * @coversNothing
 */
final class TaskLimitTest extends TestCase
{
    private $keys;

    protected function setUp(): void
    {
        $this->keys = ['none', 'date', 'time'];
    }

    public function testIconPresent(): void
    {
        $this->assertKey(TaskLimitType::date()->toString());
        $this->assertKey(TaskLimitType::none()->toString());
        $this->assertKey(TaskLimitType::time()->toString());
    }

    private function assertKey(string $key): void
    {
        static::assertTrue(\in_array($key, $this->keys, true));
    }
}
