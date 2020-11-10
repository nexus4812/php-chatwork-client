<?php

declare(strict_types=1);

namespace Nexus\ChatworkClient\Entities;

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
}
