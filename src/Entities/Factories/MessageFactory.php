<?php

namespace ChatWorkClient\Entities\Factories;

use ChatWorkClient\Entities\Message;
use ChatWorkClient\Entities\MessageAccount;
use ChatWorkClient\Entities\PostMessages;
use ChatWorkClient\Entities\PutMembers;
use ChatWorkClient\Entities\PutMessage;

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
