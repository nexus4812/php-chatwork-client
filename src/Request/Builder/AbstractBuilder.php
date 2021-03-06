<?php

declare(strict_types=1);

namespace Nexus\ChatworkClient\Request\Builder;

use Nexus\ChatworkClient\Exception\LogicException;

abstract class AbstractBuilder implements InterfaceBuilder
{
    public function build(): array
    {
        $this->assert();

        $data = [];
        foreach (get_object_vars($this) as $key => $value) {
            if (!empty($value) || '0' === $value) {
                $data[$key] = $value;
            }
        }

        return $data;
    }

    /**
     * @param array<int> $array
     */
    protected function arrayIdsToString(array $array): string
    {
        foreach ($array as $id) {
            if (!\is_int($id)) {
                throw new LogicException('Id must be int');
            }
        }

        return implode(',', $array);
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
