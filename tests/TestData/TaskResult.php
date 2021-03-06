<?php

declare(strict_types=1);

namespace Nexus\ChatworkClient\Api\TestData;

trait TaskResult
{
    public function taskItemGet()
    {
        return json_decode('
          {
    "task_id": 3,
    "room": {
      "room_id": 5,
      "name": "Group Chat Name",
      "icon_path": "https://example.com/ico_group.png"
    },
    "assigned_by_account": {
      "account_id": 456,
      "name": "Anna",
      "avatar_image_url": "https://example.com/def.png"
    },
    "message_id": "13",
    "body": "buy milk",
    "limit_time": 1384354799,
    "status": "open",
    "limit_type": "date"
  }', true);
    }

    public function taskItemsGet()
    {
        return json_decode('
          [
  {
    "task_id": 3,
    "room": {
      "room_id": 5,
      "name": "Group Chat Name",
      "icon_path": "https://example.com/ico_group.png"
    },
    "assigned_by_account": {
      "account_id": 456,
      "name": "Anna",
      "avatar_image_url": "https://example.com/def.png"
    },
    "message_id": "13",
    "body": "buy milk",
    "limit_time": 1384354799,
    "status": "open",
    "limit_type": "date"
  }
]', true);
    }

    public function taskResultPost()
    {
        return json_decode('
        {
  "task_ids": [123,124]
  }     ', true);
    }

    public function taskResultPut()
    {
        return json_decode('
        {
  "task_id": 1234
  }     ', true);
    }
}
