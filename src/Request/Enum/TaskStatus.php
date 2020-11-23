<?php

declare(strict_types=1);

namespace Nexus\ChatworkClient\Request\Enum;

final class TaskStatus extends AbstractEnum implements InterfaceEnum
{
    const OPEN = 'open';
    const DONE = 'done';

    public static function open(): self
    {
        return new self(self::OPEN);
    }

    public static function done(): self
    {
        return new self(self::DONE);
    }
}
