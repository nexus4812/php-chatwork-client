<?php

declare(strict_types=1);

namespace ChatWorkClient\Entities\Factories;

use ChatWorkClient\Entities\Member;
use ChatWorkClient\Entities\PutMembers;

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
