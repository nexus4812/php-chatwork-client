<?php

declare(strict_types=1);

namespace ChatWorkClient\Entities\Factories;

use ChatWorkClient\Entities\AssignedByAccount;
use ChatWorkClient\Entities\PostTask;
use ChatWorkClient\Entities\Task;
use ChatWorkClient\Entities\TinyRoom;

class TaskFactory extends AbstractEntityFactory implements EntityFactoryInterface
{
    public function entity(array $data): Task
    {
        $r = $this->createEntity(new Task(), $data);
        $r->room = $this->createEntity(new TinyRoom(), $data['room']);
        $r->assigned_by_account = $this->createEntity(new AssignedByAccount(), $data['assigned_by_account']);

        return $r;
    }

    public function postEntity(array $data): PostTask
    {
        $r = new PostTask();
        $r->task_ids = $data['task_ids'];

        return $r;
    }
}
