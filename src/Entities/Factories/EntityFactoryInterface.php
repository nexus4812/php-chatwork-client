<?php

namespace ChatWorkClient\Entities\Factories;

use ChatWorkClient\Entities\EntityInterface;

interface EntityFactoryInterface
{
    /**
     * @param array<string> $data
     *
     * @return EntityInterface | mixed (mixed is concrete EntityInterface)
     */
    public function entity(array $data);
}
