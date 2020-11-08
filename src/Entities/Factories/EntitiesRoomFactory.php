<?php

declare(strict_types=1);

namespace Nexus\ChatworkClient\Entities\Factories;

use Nexus\ChatworkClient\Entities\EntitiesRoom;

class EntitiesRoomFactory extends AbstractEntityFactory implements EntityFactoryInterface
{
    public function entity(array $data): EntitiesRoom
    {
        return $this->createEntity(new EntitiesRoom(), $data);
    }
}
