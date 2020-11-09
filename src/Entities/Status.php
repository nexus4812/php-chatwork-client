<?php

declare(strict_types=1);

namespace Nexus\ChatworkClient\Entities;

class Status implements EntityInterface
{
    /**
     * @var int
     */
    public $unread_room_num;

    /**
     * @var int
     */
    public $mention_room_num;

    /**
     * @var int
     */
    public $mytask_room_num;

    /**
     * @var int
     */
    public $unread_num;

    /**
     * @var int
     */
    public $mention_num;

    /**
     * @var int
     */
    public $mytask_num;
}
