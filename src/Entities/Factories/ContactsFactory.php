<?php

declare(strict_types=1);

namespace Nexus\ChatworkClient\Entities\Factories;

use Nexus\ChatworkClient\Entities\Contacts;

class ContactsFactory extends AbstractEntityFactory implements EntityFactoryInterface
{
    public function entity(array $data): Contacts
    {
        return $this->createEntity(new Contacts(), $data);
    }
}
