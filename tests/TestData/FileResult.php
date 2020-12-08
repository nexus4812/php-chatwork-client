<?php

declare(strict_types=1);

namespace Nexus\ChatworkClient\Api\TestData;

trait FileResult
{
    public function fileItemGet()
    {
        return    json_decode('
{
  "file_id":3,
  "account": {
    "account_id":123,
    "name":"Bob",
    "avatar_image_url": "https://example.com/ico_avatar.png"
  },
  "message_id": "22",
  "filename": "README.md",
  "filesize": 2232,
  "upload_time": 1384414750
}', true);
    }

    public function fileItemsGet()
    {
        return json_decode('
[
  {
    "file_id": 3,
    "account": {
      "account_id": 123,
      "name": "Bob",
      "avatar_image_url": "https://example.com/ico_avatar.png"
    },
    "message_id": "22",
    "filename": "README.md",
    "filesize": 2232,
    "upload_time": 1384414750
  }
]', true);
    }

    public function fileItemsPost()
    {
        return json_decode('
{
  "file_id": 1234
}', true);
    }
}
