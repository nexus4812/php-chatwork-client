<?php

declare(strict_types=1);

namespace Nexus\ChatworkClient\Entities;

use Carbon\CarbonImmutable;

class Message implements EntityInterface
{
    /**
     * @var string
     */
    public $message_id;

    /**
     * @var Account
     */
    public $account;

    /**
     * @var string
     */
    public $body;

    /**
     * @var int
     */
    public $send_time;

    /**
     * @var int
     */
    public $update_time;

    public function sendTime(): CarbonImmutable
    {
        return CarbonImmutable::createFromTimestamp($this->send_time);
    }

    public function updateTime(): CarbonImmutable
    {
        return CarbonImmutable::createFromTimestamp($this->update_time);
    }
}
