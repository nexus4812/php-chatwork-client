<?php


namespace ChatWorkClient\Entities;

class Message implements EntityInterface
{
    public $message_id;

    /**
     * @var MessageAccount
     */
    public $account;

    public $body;

    public $send_time;

    public $update_time;
}
