<?php

declare(strict_types=1);

namespace Nexus\ChatworkClient\Entities\Factories;

use Nexus\ChatworkClient\Entities\EntityInterface;

interface EntityFactoryInterface
{
    /**
     * @param array<string> $data
     *
     * @return EntityInterface | mixed (mixed is concrete EntityInterface)
     */
    public function entity(array $data);
}
