<?php

namespace ChatWorkClient\Entities\Factories;

use ChatWorkClient\Entities\Link;

class LinkFactory extends AbstractEntityFactory implements EntityFactoryInterface
{
    public function entity(array $data): Link
    {
        return $this->createEntity(new Link(), $data);
    }
}
