<?php

declare(strict_types=1);

namespace ChatWorkClient\Entities;

class PutMessage implements EntityInterface
{
    public $unread_num;

    public $mention_num;
}
