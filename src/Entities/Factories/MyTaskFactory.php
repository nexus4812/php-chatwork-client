<?php

namespace ChatWorkClient\Entities\Factories;

use ChatWorkClient\Entities\AssignedByAccount;
use ChatWorkClient\Entities\MyTask;
use ChatWorkClient\Entities\Room;

class MyTaskFactory extends AbstractEntityFactory implements EntityFactoryInterface
{
    public function entity(array $task): MyTask
    {
        $taskEntity = $this->createEntity(new MyTask(), $task);
        $taskEntity->assigned_by_account = $this->createAssignedByAccountEntity($task['assigned_by_account']);
        $taskEntity->room = $this->createRoomEntity($task['room']);

        return $taskEntity;
    }

    private function createAssignedByAccountEntity(array $data): AssignedByAccount
    {
        return $this->createEntity(new AssignedByAccount(), $data);
    }

    private function createRoomEntity(array $data): Room
    {
        return $this->createEntity(new Room(), $data);
    }
}
