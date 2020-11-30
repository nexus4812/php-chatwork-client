<?php

declare(strict_types=1);

namespace Nexus\ChatworkClient\Api\TestData;

trait MessageResult
{
    public function messageItemsGet()
    {
        return  json_decode('
[
  {
    "message_id": "5",
    "account": {
      "account_id": 123,
      "name": "Bob",
      "avatar_image_url": "https://example.com/ico_avatar.png"
    },
    "body": "Hello Chatwork!",
    "send_time": 1384242850,
    "update_time": 0
  }
]', true);
    }

    public function messageItemGet()
    {
        return  json_decode('
{
  "message_id": "5",
  "account": {
    "account_id": 123,
    "name": "Bob",
    "avatar_image_url": "https://example.com/ico_avatar.png"
  },
  "body": "Hello Chatwork!",
  "send_time": 1384242850,
  "update_time": 0
}', true);
    }

    public function messageItemPutRead()
    {
        return json_decode('
{
  "unread_num": 461,
  "mention_num": 0
}', true);
    }

    public function messageItemPut()
    {
        return json_decode('
{
  "message_id": "1234"
}', true);
    }

    public function messageItemPost()
    {
        return json_decode('
{
  "message_id": "1234"
}', true);
    }

    public function messageItemDelete()
    {
        return json_decode('
{
  "message_id": "1234"
}', true);
    }
}
