<?php

declare(strict_types=1);

namespace ChatWorkClient\Entities\Factories;

use ChatWorkClient\Entities\EntityRoom;

class EntityRoomFactory extends AbstractEntityFactory implements EntityFactoryInterface
{
    public function entity(array $data): EntityRoom
    {
        return $this->createEntity(new EntityRoom(), $data);
    }
}
