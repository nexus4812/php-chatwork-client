<?php

declare(strict_types=1);

namespace Nexus\ChatworkClient\Entities;

use Carbon\CarbonImmutable;

class Room
{
    /**
     * @var int
     */
    public $room_id;

    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $type;

    /**
     * @var string
     */
    public $role;

    /**
     * @var bool
     */
    public $sticky;
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

    /**
     * @var int
     */
    public $message_num;

    /**
     * @var int
     */
    public $file_num;

    /**
     * @var int
     */
    public $task_num;

    /**
     * @var int
     */
    public $icon_path;

    /**
     * @var int
     */
    public $last_update_time;

    /**
     * @var string Only GET /rooms/{room_id}
     */
    public $description;

    public function lastUpdateTime(): CarbonImmutable
    {
        return CarbonImmutable::createFromTimestamp($this->last_update_time);
    }
}
