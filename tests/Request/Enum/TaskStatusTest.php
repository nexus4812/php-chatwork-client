<?php

declare(strict_types=1);

namespace Nexus\ChatworkClient\Entities\Factories;

use Nexus\ChatworkClient\Request\Enum\TaskStatus;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 * @coversNothing
 */
final class TaskStatusTest extends TestCase
{
    private $keys;

    protected function setUp(): void
    {
        $this->keys = ['open', 'done'];
    }

    public function testIconPresent(): void
    {
        $this->assertKey(TaskStatus::open()->toString());
        $this->assertKey(TaskStatus::done()->toString());
    }

    private function assertKey(string $key): void
    {
        static::assertTrue(\in_array($key, $this->keys, true));
    }
}
