<?php

declare(strict_types=1);

namespace Nexus\ChatworkClient\Entities\Factories;

use Nexus\ChatworkClient\Entities\IncomingRequest;

class IncomingRequestFactory extends AbstractEntityFactory implements EntityFactoryInterface
{
    public function entity(array $data): IncomingRequest
    {
        return $this->createEntity(new IncomingRequest(), $data);
    }
}
