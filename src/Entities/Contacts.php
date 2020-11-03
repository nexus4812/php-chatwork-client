<?php

namespace ChatWorkClient\Entities;

class Contacts implements EntityInterface
{
    public $account_id;
    public $room_id;
    public $name;
    public $chatwork_id;
    public $organization_id;
    public $organization_name;
    public $department;
    public $avatar_image_url;
}
