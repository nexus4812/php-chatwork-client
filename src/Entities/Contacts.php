<?php

declare(strict_types=1);

namespace ChatWorkClient\Entities;

class Contacts implements EntityInterface
{
    /**
     * @var int
     */
    public $account_id;
    /**
     * @var int
     */
    public $room_id;

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
