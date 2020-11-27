<?php

declare(strict_types=1);

namespace Nexus\ChatworkClient\Request\Builder;

interface InterfaceBuilder
{
    /**
     * @return array<string>
     */
    public function build(): array;
}
