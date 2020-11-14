<?php

declare(strict_types=1);

namespace Nexus\ChatworkClient\Api\TestData;

trait StatusResult
{
    public function statusItemGet()
    {
        return json_decode('
          {
  "unread_room_num": 2,
  "mention_room_num": 1,
  "mytask_room_num": 3,
  "unread_num": 12,
  "mention_num": 1,
  "mytask_num": 8
  }', true);
    }
}
