<?php

declare(strict_types=1);

namespace Nexus\ChatworkClient\Request\Enum;

final class ActionType extends AbstractEnum
{
    const LEAVE = 'leave';
    const DELETE = 'delete';

    public static function leave(): self
    {
        return new self(self::LEAVE);
    }

    public static function delete(): self
    {
        return new self(self::DELETE);
    }
}
