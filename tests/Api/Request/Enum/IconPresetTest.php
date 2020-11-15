<?php

declare(strict_types=1);

namespace Nexus\ChatworkClient\Entities\Factories;

use Nexus\ChatworkClient\Request\Enum\IconPreset;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 * @coversNothing
 */
final class IconPresetTest extends TestCase
{
    private $keys;

    protected function setUp(): void
    {
        $this->keys = ['group', 'check', 'document', 'meeting', 'event', 'project', 'business', 'study', 'security', 'star', 'idea', 'heart', 'magcup', 'beer', 'music', 'sports', 'travel'];
    }

    public function testIconPresent(): void
    {
        static ::assertSame((string) IconPreset::notUsed(), '');
        $this->assertKey(IconPreset::group()->toString());
        $this->assertKey(IconPreset::check()->toString());
        $this->assertKey(IconPreset::document()->toString());
        $this->assertKey(IconPreset::meeting()->toString());
        $this->assertKey(IconPreset::event()->toString());
        $this->assertKey(IconPreset::project()->toString());
        $this->assertKey(IconPreset::business()->toString());
        $this->assertKey(IconPreset::study()->toString());
        $this->assertKey(IconPreset::security()->toString());
        $this->assertKey(IconPreset::star()->toString());
        $this->assertKey(IconPreset::idea()->toString());
        $this->assertKey(IconPreset::heart()->toString());
        $this->assertKey(IconPreset::magcup()->toString());
        $this->assertKey(IconPreset::beer()->toString());
        $this->assertKey(IconPreset::music()->toString());
        $this->assertKey(IconPreset::sport()->toString());
        $this->assertKey(IconPreset::travel()->toString());
    }

    private function assertKey(string $key): void
    {
        static::assertTrue(\in_array($key, $this->keys, true));
    }
}
