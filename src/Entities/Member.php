<?php

declare(strict_types=1);

namespace Nexus\ChatworkClient\Entities;

class Member implements EntityInterface
{
    public $account_id;
    public $role;
    public $name;
    public $chatwork_id;
    public $organization_id;
    public $organization_name;
    public $department;
    public $avatar_image_url;
}
