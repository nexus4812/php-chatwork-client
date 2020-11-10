<?php

declare(strict_types=1);

namespace Nexus\ChatworkClient\Entities;

class Member implements EntityInterface
{
    /**
     * @var int
     */
    public $account_id;

    /**
     * @var string
     */
    public $role;

    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $chatwork_id;

    /**
     * @var int
     */
    public $organization_id;

    /**
     * @var string
     */
    public $organization_name;

    /**
     * @var string
     */
    public $department;

    /**
     * @var string
     */
    public $avatar_image_url;
}
