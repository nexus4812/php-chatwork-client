<?php

declare(strict_types=1);

namespace Nexus\ChatworkClient\Entities\Factories;

use Nexus\ChatworkClient\Entities\AssignedByAccount;
use Nexus\ChatworkClient\Entities\Task;
use Nexus\ChatworkClient\Entities\TinyRoom;

class MyTaskFactory extends AbstractEntityFactory implements EntityFactoryInterface
{
    public function entity(array $task): Task
    {
        $taskEntity = $this->createEntity(new Task(), $task);
        $taskEntity->assigned_by_account = $this->createAssignedByAccountEntity($task['assigned_by_account']);
        $taskEntity->room = $this->createRoomEntity($task['room']);

        return $taskEntity;
    }

    private function createAssignedByAccountEntity(array $data): AssignedByAccount
    {
        return $this->createEntity(new AssignedByAccount(), $data);
    }

    private function createRoomEntity(array $data): TinyRoom
    {
        return $this->createEntity(new TinyRoom(), $data);
    }
}
