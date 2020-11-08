<?php

declare(strict_types=1);

namespace Nexus\ChatworkClient\Entities;

class Account implements EntityInterface
{
    public $account_id;
    public $name;
    public $avatar_image_url;
}
