<?php

declare(strict_types=1);

namespace Nexus\ChatworkClient\Entities\Factories;

use Nexus\ChatworkClient\Entities\Message;
use Nexus\ChatworkClient\Entities\MessageAccount;
use Nexus\ChatworkClient\Entities\PostMessages;
use Nexus\ChatworkClient\Entities\PutMessage;

class MessageFactory extends AbstractEntityFactory implements EntityFactoryInterface
{
    public function entity(array $data): Message
    {
        $message = $this->createEntity(new Message(), $data);
        $message->account = $this->createEntity(new MessageAccount(), $data['account']);

        return $message;
    }

    public function postEntity(array $data): PostMessages
    {
        return $this->createEntity(new PostMessages(), $data);
    }

    public function putEntity(array $data): PutMessage
    {
        return $this->createEntity(new PutMessage(), $data);
    }
}
