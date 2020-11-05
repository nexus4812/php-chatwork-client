<?php

declare(strict_types=1);

namespace ChatWorkClient\Entities;

class File
{
    public $file_id;
    /**
     * @var Account
     */
    public $accountId;
    public $message_id;
    public $filename;
    public $filesize;
    public $upload_time;
}
