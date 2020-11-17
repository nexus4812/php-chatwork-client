<?php

declare(strict_types=1);

namespace Nexus\ChatworkClient\Api\TestData;

trait MemberResult
{
    public function memberItemsGet()
    {
        return  json_decode('
         [
  {
    "account_id": 123,
    "role": "member",
    "name": "John Smith",
    "chatwork_id": "tarochatworkid",
    "organization_id": 101,
    "organization_name": "Hello Company",
    "department": "Marketing",
    "avatar_image_url": "https://example.com/abc.png"
  }
]', true);
    }

    public function memberItemPut()
    {
        return json_decode('
{
  "admin": [123, 542, 1001],
  "member": [10, 103],
  "readonly": [6, 11]
}', true);
    }
}
