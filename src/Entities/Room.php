<?php

namespace ChatWorkClient\Entities;

class Room
{
    public $room_id;
    public $name;
    public $type;
    public $role;
    public $sticky;
    public $unread_num;
    public $mention_num;
    public $mytask_num;
    public $message_num;
    public $file_num;
    public $task_num;
    public $icon_path;
    public $last_update_time;
    public $description;
}