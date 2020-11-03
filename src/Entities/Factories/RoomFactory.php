<?php


namespace ChatWorkClient\Entities\Factories;

use ChatWorkClient\Entities\Room;

class RoomFactory extends AbstractEntityFactory implements EntityFactoryInterface
{
    public function entity(array $data): Room
    {
        return $this->createEntity(new Room(), $data);
    }
}
