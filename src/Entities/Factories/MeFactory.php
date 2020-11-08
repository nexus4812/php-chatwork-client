<?php

declare(strict_types=1);

namespace Nexus\ChatworkClient\Entities\Factories;

use Nexus\ChatworkClient\Entities\Me;

class MeFactory extends AbstractEntityFactory implements EntityFactoryInterface
{
    public function entity(array $data): Me
    {
        return $this->createEntity(new Me(), $data);
    }
}
