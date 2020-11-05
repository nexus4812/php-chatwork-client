<?php

declare(strict_types=1);

namespace ChatWorkClient\Api\EndPoints;

use ChatWorkClient\Client\ClientInterface;
use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;
use Prophecy\Prophecy\ObjectProphecy;

/**
 * @internal
 * @coversNothing
 */
class AbstractEndPointForUnit extends TestCase
{
    use ProphecyTrait;

    protected function createClientProphecy(): ObjectProphecy
    {
        return $this->prophesize(ClientInterface::class);
    }

    protected function jsonDataToArray(string $jsonString): array
    {
        return [
            [json_decode($jsonString, true)],
        ];
    }
}
