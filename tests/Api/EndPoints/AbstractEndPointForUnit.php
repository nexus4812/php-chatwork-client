<?php

namespace ChatWorkClient\Api\EndPoints;

use ChatWorkClient\Client\ClientInterface;
use PHPStan\Testing\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;
use Prophecy\Prophecy\ObjectProphecy;

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
