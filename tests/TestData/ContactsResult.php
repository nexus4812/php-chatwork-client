<?php

declare(strict_types=1);

namespace Nexus\ChatworkClient\Api\TestData;

trait ContactsResult
{
    public function contactsItemGet()
    {
        return json_decode('{
    "account_id": 123,
    "room_id": 322,
    "name": "John Smith",
    "chatwork_id": "tarochatworkid",
    "organization_id": 101,
    "organization_name": "Hello Company",
    "department": "Marketing",
    "avatar_image_url": "https://example.com/abc.png"
  }', true);
    }

    public function contactsItemsGet()
    {
        return json_decode('[{
    "account_id": 123,
    "room_id": 322,
    "name": "John Smith",
    "chatwork_id": "tarochatworkid",
    "organization_id": 101,
    "organization_name": "Hello Company",
    "department": "Marketing",
    "avatar_image_url": "https://example.com/abc.png"
  }]', true);
    }
}
