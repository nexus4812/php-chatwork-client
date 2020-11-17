<?php

declare(strict_types=1);

namespace Nexus\ChatworkClient\Api\TestData;

trait LinkResult
{
    public function linkItemGet()
    {
        return json_decode('
         {
  "public": true,
  "url": "https://example.chatwork.com/g/randomcode42",
  "need_acceptance": true,
  "description": "Link description text"
}', true);
    }
}
