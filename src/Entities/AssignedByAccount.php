<?php

declare(strict_types=1);

namespace ChatWorkClient\Entities;

class AssignedByAccount implements EntityInterface
{
    /**
     * @var string
     */
    public $account_id;

    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $avatar_image_url;
}
