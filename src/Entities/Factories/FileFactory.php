<?php

namespace ChatWorkClient\Entities\Factories;

use ChatWorkClient\Entities\File;

class FileFactory extends AbstractEntityFactory implements EntityFactoryInterface
{
    public function entity(array $data): File
    {
        return $this->createEntity(new File(), $data);
    }
}
