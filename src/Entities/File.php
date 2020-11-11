<?php

declare(strict_types=1);

namespace Nexus\ChatworkClient\Entities;

class File
{
    /**
     * @var int
     */
    public $file_id;
    /**
     * @var Account
     */
    public $account;

    /**
     * @var string
     */
    public $message_id;

    /**
     * @var string
     */
    public $filename;

    /**
     * @var int
     */
    public $filesize;

    /**
     * @var int
     */
    public $upload_time;
}
