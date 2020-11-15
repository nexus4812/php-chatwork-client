<?php

declare(strict_types=1);

namespace Nexus\ChatworkClient\Request\Enum;

abstract class AbstractEnum
{
    /**
     * @var string
     */
    protected $status;

    protected function __construct(string $status)
    {
        $this->status = $status;
    }

    public function __toString(): string
    {
        return $this->status;
    }

    public function toString(): string
    {
        return $this->status;
    }
}
