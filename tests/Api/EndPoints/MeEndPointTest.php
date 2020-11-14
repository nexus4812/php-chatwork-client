<?php

declare(strict_types=1);

namespace Nexus\ChatworkClient\Api\EndPoints;

use Nexus\ChatworkClient\Api\TestData\MeResult;
use Nexus\ChatworkClient\Client\ClientInterface;
use Nexus\ChatworkClient\Entities\Factories\MeFactory;
use Nexus\ChatworkClient\Entities\Me;
use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;

/**
 * @internal
 * @coversNothing
 */
final class MeEndPointTest extends TestCase
{
    use ProphecyTrait;
    use MeResult;

    public function testGetMe(): void
    {
        $clientProphecy = $this->prophesize(ClientInterface::class);
        $clientProphecy->get('me')->willReturn($this->getMeItem());

        $endPoint = new MeEndPoint($clientProphecy->reveal(), new MeFactory());
        static::assertInstanceOf(Me::class, $endPoint->getMe());
    }
}
