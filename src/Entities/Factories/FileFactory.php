<?php

declare(strict_types=1);

namespace Nexus\ChatworkClient\Entities\Factories;

use Nexus\ChatworkClient\Entities\Account;
use Nexus\ChatworkClient\Entities\File;

class FileFactory extends AbstractEntityFactory implements EntityFactoryInterface
{
    public function entity(array $data): File
    {
        $r = $this->createEntity(new File(), $data);
        $r->account = $this->createEntity(new Account(), $data['account']);

        return $r;
    }
}
