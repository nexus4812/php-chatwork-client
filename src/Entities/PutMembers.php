<?php

declare(strict_types=1);

namespace Nexus\ChatworkClient\Entities;

class PutMembers implements EntityInterface
{
    /**
     * @var array<int> Admin user ids
     */
    public $admin;

    /**
     * @var array<int> Member user ids
     */
    public $member;

    /**
     * @var array<int> Read only user ids
     */
    public $readonly;
}
