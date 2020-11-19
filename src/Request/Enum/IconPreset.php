<?php

declare(strict_types=1);

namespace Nexus\ChatworkClient\Request\Enum;

final class IconPreset extends AbstractEnum implements InterfaceEnum
{
    const GROUP = 'group';
    const CHECK = 'check';
    const DOCUMENT = 'document';
    const MEETING = 'meeting';
    const EVENT = 'event';
    const PROJECT = 'project';
    const BUSINESS = 'business';
    const STUDY = 'study';
    const SECURITY = 'security';
    const STAR = 'star';
    const IDEA = 'idea';
    const HEART = 'heart';
    const MAGCUP = 'magcup';
    const BEER = 'beer';
    const MUSIC = 'music';
    const SPORTS = 'sports';
    const TRAVEL = 'travel';

    public static function group(): self
    {
        return new self(self::GROUP);
    }

    public static function check(): self
    {
        return new self(self::CHECK);
    }

    public static function document(): self
    {
        return new self(self::DOCUMENT);
    }

    public static function meeting(): self
    {
        return new self(self::MEETING);
    }

    public static function event(): self
    {
        return new self(self::EVENT);
    }

    public static function project(): self
    {
        return new self(self::PROJECT);
    }

    public static function business(): self
    {
        return new self(self::BUSINESS);
    }

    public static function study(): self
    {
        return new self(self::STUDY);
    }

    public static function security(): self
    {
        return new self(self::SECURITY);
    }

    public static function star(): self
    {
        return new self(self::STAR);
    }

    public static function idea(): self
    {
        return new self(self::IDEA);
    }

    public static function heart(): self
    {
        return new self(self::HEART);
    }

    public static function magcup(): self
    {
        return new self(self::MAGCUP);
    }

    public static function beer(): self
    {
        return new self(self::BEER);
    }

    public static function music(): self
    {
        return new self(self::MUSIC);
    }

    public static function sport(): self
    {
        return new self(self::SPORTS);
    }

    public static function travel(): self
    {
        return new self(self::TRAVEL);
    }
}
