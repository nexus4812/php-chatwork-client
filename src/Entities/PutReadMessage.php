<?php

declare(strict_types=1);

namespace Nexus\ChatworkClient\Entities;

class PutReadMessage implements EntityInterface
{
    /**
     * @var int
     */
    public $unread_num;

    /**
     * @var int
     */
    public $mention_num;
}
