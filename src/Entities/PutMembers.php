<?php

declare(strict_types=1);

namespace Nexus\ChatworkClient\Entities;

class PutMembers implements EntityInterface
{
    /**
     * @var array<int>
     */
    public $members_admin_ids;

    /**
     * @var array<int>
     */
    public $members_member_ids;

    /**
     * @var array<int>
     */
    public $members_readonly_ids;
}
