<?php

declare(strict_types=1);

namespace Nexus\ChatworkClient\Request\Builder;

use LogicException;
use Nexus\ChatworkClient\Request\Enum\IconPreset;

class PostRoomBuilder extends AbstractBuilder implements InterfaceBuilder
{
    /**
     * @var string グループチャット名 (必須)
     */
    protected $name;

    /**
     * @var array<int> 閲覧のみ権限のユーザー
     */
    protected $members_readonly_ids;

    /**
     * @var array<int> メンバー権限のユーザー
     */
    protected $members_member_ids;

    /**
     * @var array<int> 管理者権限のユーザー (必須)
     */
    protected $members_admin_ids;

    /**
     * @var bool 承認要否 : 参加に管理者の承認を必要とするか
     */
    protected $link_need_acceptance;

    /**
     * @var string 招待リンク作成
     */
    protected $link_code;

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

    /**
     * @param $ids array<int>
     *
     * @return PostRoomBuilder
     */
    public function setMembersReadonlyIds(array $ids): self
    {
        $this->members_readonly_ids = $ids;

        return $this;
    }

    /**
     * @param $ids array<int>
     */
    public function setMembersMemberIds(array $ids): self
    {
        $this->members_member_ids = $ids;

        return $this;
    }

    /**
     * @param $ids array<int>
     */
    public function setMembersAdminIds(array $ids): self
    {
        $this->members_admin_ids = $ids;

        return $this;
    }

    public function setLinkNeedAcceptance(bool $link_need_acceptance): self
    {
        $this->link_need_acceptance = $link_need_acceptance;

        return $this;
    }

    public function setLinkCode(string $link_code): self
    {
        $this->link_code = $link_code;

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

    protected function assert(): void
    {
        $this->assertRoomNameIsProvided();
        $this->assertAdminIdsIsProvided();
    }

    private function assertRoomNameIsProvided(): void
    {
        if (empty($this->name)) {
            throw new LogicException('Room name must be required');
        }
    }

    private function assertAdminIdsIsProvided(): void
    {
        if (empty($this->members_admin_ids) || !\is_int($this->members_admin_ids[0])) {
            throw new LogicException('At least one admin id must be provided');
        }
    }
}
