<?php

declare(strict_types=1);

namespace Nexus\ChatworkClient\Entities;

use Carbon\CarbonImmutable;

class Task implements EntityInterface
{
    /**
     * @var int
     */
    public $task_id;

    /**
     * @var OmittedRoom
     */
    public $room;

    /**
     * @var AssignedByAccount
     */
    public $assigned_by_account;

    /**
     * @var string
     */
    public $message_id;

    /**
     * @var string
     */
    public $body;

    /**
     * @var int
     */
    public $limit_time;

    /**
     * @var string
     */
    public $status;

    /**
     * @var int
     */
    public $limit_type;

    public function limitTime(): CarbonImmutable
    {
        return CarbonImmutable::createFromTimestamp($this->limit_time);
    }
}
