<?php

declare(strict_types=1);

namespace Nexus\ChatworkClient\Api;

use Nexus\ChatworkClient\Api\EndPoints\ContactsEndPoint;
use Nexus\ChatworkClient\Api\EndPoints\IncomingRequestsEndPoint;
use Nexus\ChatworkClient\Api\EndPoints\MeEndPoint;
use Nexus\ChatworkClient\Api\EndPoints\MyEndPoint;
use Nexus\ChatworkClient\Api\EndPoints\RoomEndPoint;
use Nexus\ChatworkClient\Client\ClientFactory;
use Nexus\ChatworkClient\Client\ClientInterface;
use Nexus\ChatworkClient\Entities\Factories\ContactsFactory;
use Nexus\ChatworkClient\Entities\Factories\EntityRoomFactory;
use Nexus\ChatworkClient\Entities\Factories\FileFactory;
use Nexus\ChatworkClient\Entities\Factories\IncomingRequestFactory;
use Nexus\ChatworkClient\Entities\Factories\LinkFactory;
use Nexus\ChatworkClient\Entities\Factories\MeFactory;
use Nexus\ChatworkClient\Entities\Factories\MemberFactory;
use Nexus\ChatworkClient\Entities\Factories\MessageFactory;
use Nexus\ChatworkClient\Entities\Factories\MyTaskFactory;
use Nexus\ChatworkClient\Entities\Factories\StatusFactory;
use Nexus\ChatworkClient\Entities\Factories\TaskFactory;

class Chatwork
{
    /**
     * @var ClientInterface
     */
    private $client;

    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    public static function create(string $chatWorkApiToken): self
    {
        return new self((new ClientFactory())->guzzleHttp($chatWorkApiToken));
    }

    public function me(): MeEndPoint
    {
        return new MeEndPoint($this->client, new MeFactory());
    }

    public function my(): MyEndPoint
    {
        return new MyEndPoint($this->client, new StatusFactory(), new MyTaskFactory());
    }

    public function contacts(): ContactsEndPoint
    {
        return new ContactsEndPoint($this->client, new ContactsFactory());
    }

    public function room(): RoomEndPoint
    {
        return new RoomEndPoint(
            $this->client,
            new EntityRoomFactory(),
            new MemberFactory(),
            new MessageFactory(),
            new TaskFactory(),
            new LinkFactory(),
            new FileFactory()
        );
    }

    public function IncomingRequest(): IncomingRequestsEndPoint
    {
        return new IncomingRequestsEndPoint($this->client, new IncomingRequestFactory());
    }
}
