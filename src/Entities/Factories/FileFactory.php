<?php

declare(strict_types=1);

namespace Nexus\ChatworkClient\Entities\Factories;

use Nexus\ChatworkClient\Entities\File;

class FileFactory extends AbstractEntityFactory implements EntityFactoryInterface
{
    public function entity(array $data): File
    {
        return $this->createEntity(new File(), $data);
    }
}
