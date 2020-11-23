<?php

declare(strict_types=1);

namespace Nexus\ChatworkClient\Request\Enum;

final class TaskLimitType extends AbstractEnum implements InterfaceEnum
{
    const NONE = 'none';
    const DATE = 'date';
    const TIME = 'time';

    public static function none(): self
    {
        return new self(self::NONE);
    }

    public static function date(): self
    {
        return new self(self::DATE);
    }

    public static function time(): self
    {
        return new self(self::TIME);
    }
}
