<?php

declare(strict_types=1);

namespace Nexus\ChatworkClient\Entities\Factories;

use Nexus\ChatworkClient\Entities\Link;

class LinkFactory extends AbstractEntityFactory implements EntityFactoryInterface
{
    public function entity(array $data): Link
    {
        return $this->createEntity(new Link(), $data);
    }
}
