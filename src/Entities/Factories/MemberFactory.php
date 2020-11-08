<?php

declare(strict_types=1);

namespace Nexus\ChatworkClient\Entities\Factories;

use Nexus\ChatworkClient\Entities\Member;
use Nexus\ChatworkClient\Entities\PutMembers;

class MemberFactory extends AbstractEntityFactory implements EntityFactoryInterface
{
    public function entity(array $data): Member
    {
        return $this->createEntity(new Member(), $data);
    }

    public function putEntity(array $data): PutMembers
    {
        return $this->createEntity(new PutMembers(), $data);
    }
}
