<?php


namespace ChatWorkClient\Entities\Factories;

use ChatWorkClient\Entities\IncomingRequest;

class IncomingRequestFactory extends AbstractEntityFactory implements EntityFactoryInterface
{
    public function entity(array $data): IncomingRequest
    {
        return $this->createEntity(new IncomingRequest(), $data);
    }
}
