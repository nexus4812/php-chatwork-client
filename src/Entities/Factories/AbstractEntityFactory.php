<?php

declare(strict_types=1);

namespace ChatWorkClient\Entities\Factories;

use ChatWorkClient\Entities\EntityInterface;

abstract class AbstractEntityFactory implements EntityFactoryInterface
{
    /**
     * @param $entity EntityInterface|mixed
     * @param array<string> $columns
     *
     * @return EntityInterface | mixed
     *
     * (mixed is concrete EntityInterface)
     */
    protected function createEntity($entity, array $columns)
    {
        foreach ($columns as $key => $value) {
            $entity->$key = $value;
        }

        return $entity;
    }

    /**
     * @param $data array<string,array<string>>
     *
     * @return array<EntityInterface,mixed> (mixed is concrete EntityInterface)
     */
    public function entities(array $data): array
    {
        $r = [];
        foreach ($data as $datum) {
            $r[] = $this->entity($datum);
        }

        return $r;
    }
}
