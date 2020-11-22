<?php

declare(strict_types=1);

namespace Nexus\ChatworkClient\Request\Decorator;

class MessageDecorator
{
    public static function to(int $accountId): string
    {
        return "[To:{$accountId}]";
    }

    public static function reply(int $accountId, int $roomId, int $messageId): string
    {
        return "[rp aid={$accountId} to={$roomId}-{$messageId}]";
    }

    public static function quote(int $accountId, string $body, int $timestamp): string
    {
        return "[qt][qtmeta aid={$accountId} time={$timestamp}]{$body}[/qt]";
    }

    public static function titleStart(): string
    {
        return '[title]';
    }

    public static function titleEnd(): string
    {
        return '[/title]';
    }

    public static function title(string $title): string
    {
        return self::titleStart().$title.self::titleEnd();
    }

    public static function infoStart(): string
    {
        return '[info]';
    }

    public static function infoEnd(): string
    {
        return '[/info]';
    }

    public static function info(string $body): string
    {
        return "[info]{$body}[/info]";
    }

    public static function informationTitle(string $title, string $body): string
    {
        return self::info(self::title($title).$body);
    }

    public static function hr(): string
    {
        return '[hr]';
    }

    public static function profileIcon(int $accountId): string
    {
        return "[picon:{$accountId}]";
    }

    public static function profileIconName(int $accountId): string
    {
        return "[piconname:{$accountId}]";
    }
}
