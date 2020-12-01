<?php

declare(strict_types=1);

namespace Nexus\ChatworkClient\Request\Builder;

use Nexus\ChatworkClient\Exception\LogicException;

class PutMembersBuilder extends AbstractBuilder implements InterfaceBuilder
{
    /**
     * @var array<int>
     */
    protected $members_admin_ids;

    /**
     * @var array<int>
     */
    protected $members_member_ids;

    /**
     * @var array<int>
     */
    protected $members_readonly_ids;

    public function setAdminIds(array $adminIds): self
    {
        $this->members_admin_ids = $this->arrayIdsToString($adminIds);

        return $this;
    }

    public function setMemberIds(array $memberIds): self
    {
        $this->members_member_ids = $this->arrayIdsToString($memberIds);

        return $this;
    }

    public function setReadonlyIds(array $readonlyIds): self
    {
        $this->members_readonly_ids = $this->arrayIdsToString($readonlyIds);

        return $this;
    }

    public function setAdminId(int ...$adminIds): self
    {
        return $this->setAdminIds($adminIds);
    }

    public function setMemberId(int ...$memberIds): self
    {
        return $this->setMemberIds($memberIds);
    }

    public function setReadonlyId(int ...$readonlyIds): self
    {
        return $this->setReadonlyIds($readonlyIds);
    }

    protected function assert(): void
    {
        $this->assertAdminIdIsProvided();
    }

    private function assertAdminIdIsProvided(): void
    {
        if (empty($this->members_admin_ids)) {
            throw new LogicException('Admin ids must be required');
        }
    }
}
