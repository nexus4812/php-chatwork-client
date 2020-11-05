<?php

declare(strict_types=1);

namespace ChatWorkClient\Entities;

use Carbon\CarbonImmutable;

class MyTask implements EntityInterface
{
    /**
     * @var string
     */
    public $task_id;

    /**
     * @var string
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
     * @var string
     */
    public $limit_time;

    /**
     * @var string
     */
    public $status;

    /**
     * @var string
     */
    public $limit_type;

    public function limitTime(): CarbonImmutable
    {
        return CarbonImmutable::createFromTimestamp($this->limit_time);
    }
}
