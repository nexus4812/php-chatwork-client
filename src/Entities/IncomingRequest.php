<?php

declare(strict_types=1);

namespace Nexus\ChatworkClient\Entities;

class IncomingRequest
{
    public $request_id;
    public $account_id;
    public $message;
    public $name;
    public $chatwork_id;
    public $organization_id;
    public $organization_name;
    public $department;
    public $avatar_image_url;
}
