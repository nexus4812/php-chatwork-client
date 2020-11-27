<?php

declare(strict_types=1);

namespace Nexus\ChatworkClient\Request\Builder;

use Carbon\CarbonInterface;
use LogicException;
use Nexus\ChatworkClient\Request\Enum\TaskLimitType;

class PostTaskBuilder extends AbstractBuilder implements InterfaceBuilder
{
    /**
     * @var string
     */
    protected $body;

    /**
     * @var int
     */
    protected $limit;

    /**
     * @var string
     */
    protected $limit_type;

    /**
     * @var array<int>
     */
    protected $to_ids;

    public function setBody(string $body): self
    {
        $this->body = $body;

        return $this;
    }

    public function setLimitByTimestamp(int $limit): self
    {
        $this->limit = $limit;

        return $this;
    }

    public function setLimitByCarbon(CarbonInterface $carbon): self
    {
        $this->limit = $carbon->timestamp;

        return $this;
    }

    public function setLimitType(TaskLimitType $enum): self
    {
        $this->limit_type = $enum->toString();

        return $this;
    }

    public function setToIds(array $toIds): self
    {
        $this->to_ids = $this->arrayIdsToString($toIds);

        return $this;
    }

    public function setToId(int ...$id): self
    {
        return $this->setToIds($id);
    }

    protected function assert(): void
    {
        $this->assertIdsIsProvided();
        $this->assertBodyIsProvided();
    }

    private function assertBodyIsProvided(): void
    {
        if (empty($this->body)) {
            throw new LogicException('Task body must be required');
        }
    }

    private function assertIdsIsProvided(): void
    {
        if (empty($this->to_ids)) {
            throw new LogicException('At least one id must be provided');
        }
    }
}
