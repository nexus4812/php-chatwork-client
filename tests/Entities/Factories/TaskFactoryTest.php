<?php

declare(strict_types=1);

namespace Nexus\ChatworkClient\Entities\Factories;

use Nexus\ChatworkClient\Api\TestData\TaskResult;
use Nexus\ChatworkClient\Entities\AssignedByAccount;
use Nexus\ChatworkClient\Entities\OmittedRoom;
use Nexus\ChatworkClient\Entities\Task;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 * @coversNothing
 */
final class TaskFactoryTest extends TestCase
{
    use TaskResult;

    /**
     * @dataProvider providerEntity
     */
    public function testFactory(Task $entity): void
    {
        static::assertInstanceOf(Task::class, $entity);
        static::assertSame($entity->task_id, 3);

        static::assertInstanceOf(OmittedRoom::class, $entity->room);
        static::assertSame($entity->room->room_id, 5);
        static::assertSame($entity->room->name, 'Group Chat Name');
        static::assertSame($entity->room->icon_path, 'https://example.com/ico_group.png');

        static::assertInstanceOf(AssignedByAccount::class, $entity->assigned_by_account);
        static::assertSame($entity->assigned_by_account->account_id, 456);
        static::assertSame($entity->assigned_by_account->name, 'Anna');
        static::assertSame($entity->assigned_by_account->avatar_image_url, 'https://example.com/def.png');

        static::assertSame($entity->message_id, '13');
        static::assertSame($entity->body, 'buy milk');
        static::assertSame($entity->limit_time, 1384354799);
        static::assertSame($entity->status, 'open');
        static::assertSame($entity->limit_type, 'date');
    }

    public function providerEntity(): iterable
    {
        $factory = new TaskFactory();
        yield [$factory->entity($this->taskItemGet())];
        yield [$factory->entities($this->taskItemsGet())[0]];
        yield [$factory->entitiesAsCollection($this->taskItemsGet())->first()];
    }
}
