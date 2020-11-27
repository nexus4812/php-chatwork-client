<?php

declare(strict_types=1);

namespace Nexus\ChatworkClient\Request\Builder;

class RoomLinkBuilder extends AbstractBuilder implements InterfaceBuilder
{
    /**
     * @var string
     */
    protected $code;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var int
     */
    protected $need_acceptance;

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function setNeedAcceptance(bool $need_acceptance): self
    {
        $this->need_acceptance = $need_acceptance ? '1' : '0';

        return $this;
    }
}
