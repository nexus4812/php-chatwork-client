<?php

declare(strict_types=1);

namespace Nexus\ChatworkClient\Entities\Factories;

use Nexus\ChatworkClient\Entities\Room;

class RoomFactory extends AbstractEntityFactory implements EntityFactoryInterface
{
    public function entity(array $data): Room
    {
        return $this->createEntity(new Room(), $data);
    }
}
