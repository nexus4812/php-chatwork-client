<?php

declare(strict_types=1);

namespace ChatWorkClient\Entities;

class Status implements EntityInterface
{
    /**
     * @var string
     */
    public $unread_room_num;

    /**
     * @var string
     */
    public $mention_room_num;

    /**
     * @var string
     */
    public $mytask_room_num;

    /**
     * @var string
     */
    public $unread_num;

    /**
     * @var string
     */
    public $mention_num;

    /**
     * @var string
     */
    public $mytask_num;
}
