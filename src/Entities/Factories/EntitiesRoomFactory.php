<?php

declare(strict_types=1);

namespace ChatWorkClient\Entities\Factories;

use ChatWorkClient\Entities\EntitiesRoom;

class EntitiesRoomFactory extends AbstractEntityFactory implements EntityFactoryInterface
{
    public function entity(array $data): EntitiesRoom
    {
        return $this->createEntity(new EntitiesRoom(), $data);
    }
}
