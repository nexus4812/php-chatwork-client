<?php

declare(strict_types=1);

namespace Nexus\ChatworkClient\Request\Builder;

use LogicException;

abstract class AbstractBuilder
{
    public function build(): array
    {
        $this->assert();

        $data = [];
        foreach ($this as $key => $value) {
            if (!empty($value) || 0 === $value) {
                $data[$key] = $value;
            }
        }

        return $data;
    }

    /**
     * 必須のプロパティが設定されているか検証する.
     *
     * @throws LogicException
     */
    protected function assert(): void
    {
    }
}
