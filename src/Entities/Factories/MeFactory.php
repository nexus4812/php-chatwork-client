<?php


namespace ChatWorkClient\Entities\Factories;

use ChatWorkClient\Entities\Me;

class MeFactory extends AbstractEntityFactory implements EntityFactoryInterface
{
    public function entity(array $data): Me
    {
        return $this->createEntity(new Me(), $data);
    }
}
