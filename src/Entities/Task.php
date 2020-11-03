<?php

namespace ChatWorkClient\Entities;

use Carbon\CarbonImmutable;

class Task implements EntityInterface
{
    public $task_id;

    /**
     * @var Account
     */
    public $account;

    /**
     * @var AssignedByAccount
     */
    public $assigned_by_account;

    public $message_id;
    public $body;
    public $limit_time;
    public $status;
    public $limit_type;

    public function limitTime(): CarbonImmutable
    {
        return CarbonImmutable::createFromTimestamp($this->limit_time);
    }
}
