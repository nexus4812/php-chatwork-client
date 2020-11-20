<?php

declare(strict_types=1);

namespace Nexus\ChatworkClient\Request\Builder;

use Nexus\ChatworkClient\Request\Enum\IconPreset;

class PutRoomBuilder extends AbstractBuilder implements InterfaceBuilder
{
    /**
     * @var string グループチャット名
     */
    protected $name;

    /**
     * @var string
     */
    protected $icon_preset;

    /**
     * @var string チャット概要
     */
    protected $description;

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function setIconPreset(IconPreset $icon_preset): self
    {
        $this->icon_preset = $icon_preset->toString();

        return $this;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }
}
