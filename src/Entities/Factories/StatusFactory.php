<?php

namespace ChatWorkClient\Entities\Factories;

use ChatWorkClient\Entities\Status;

class StatusFactory extends AbstractEntityFactory implements EntityFactoryInterface
{
    public function entity(array $data): Status
    {
        return $this->createEntity(new Status(), $data);
    }
}
