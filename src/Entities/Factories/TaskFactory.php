<?php

declare(strict_types=1);

namespace Nexus\ChatworkClient\Entities\Factories;

use Nexus\ChatworkClient\Entities\AssignedByAccount;
use Nexus\ChatworkClient\Entities\PostTask;
use Nexus\ChatworkClient\Entities\Task;
use Nexus\ChatworkClient\Entities\OmittedRoom;

class TaskFactory extends AbstractEntityFactory implements EntityFactoryInterface
{
    public function entity(array $data): Task
    {
        $r = $this->createEntity(new Task(), $data);
        $r->room = $this->createEntity(new OmittedRoom(), $data['room']);
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
