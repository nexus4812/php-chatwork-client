<?php

declare(strict_types=1);

namespace Nexus\ChatworkClient\Api\EndPoints;

use Nexus\ChatworkClient\Api\TestData\StatusResult;
use Nexus\ChatworkClient\Client\ClientInterface;
use Nexus\ChatworkClient\Entities\Factories\StatusFactory;
use Nexus\ChatworkClient\Entities\Status;
use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;

/**
 * @internal
 * @coversNothing
 */
final class MyStatusEndPointTest extends TestCase
{
    use ProphecyTrait;
    use StatusResult;

    public function testGetState(): void
    {
        $clientProphecy = $this->prophesize(ClientInterface::class);
        $clientProphecy->get('my/status')->willReturn($this->statusItemGet());

        $endPoint = new MyStatusEndPoint($clientProphecy->reveal(), new StatusFactory());
        static::assertInstanceOf(Status::class, $endPoint->getStatus());
    }
}
