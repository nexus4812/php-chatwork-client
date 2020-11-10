<?php

declare(strict_types=1);

namespace Nexus\ChatworkClient\Api;

use Nexus\ChatworkClient\Api\EndPoints\ContactsEndPoint;
use Nexus\ChatworkClient\Api\EndPoints\IncomingRequestsEndPoint;
use Nexus\ChatworkClient\Api\EndPoints\MeEndPoint;
use Nexus\ChatworkClient\Api\EndPoints\MyStatusEndPoint;
use Nexus\ChatworkClient\Api\EndPoints\MyTaskEndPoint;
use Nexus\ChatworkClient\Api\EndPoints\RoomEndPoint;
use Nexus\ChatworkClient\Api\EndPoints\RoomFileEndPoint;
use Nexus\ChatworkClient\Api\EndPoints\RoomLinkEndPoint;
use Nexus\ChatworkClient\Api\EndPoints\RoomMemberEndPoint;
use Nexus\ChatworkClient\Api\EndPoints\RoomMessageEndPoint;
use Nexus\ChatworkClient\Api\EndPoints\RoomTaskEndPoint;
use Nexus\ChatworkClient\Client\ClientFactory;
use Nexus\ChatworkClient\Client\ClientInterface;
use Nexus\ChatworkClient\Entities\Factories\ContactsFactory;
use Nexus\ChatworkClient\Entities\Factories\FileFactory;
use Nexus\ChatworkClient\Entities\Factories\IncomingRequestFactory;
use Nexus\ChatworkClient\Entities\Factories\LinkFactory;
use Nexus\ChatworkClient\Entities\Factories\MeFactory;
use Nexus\ChatworkClient\Entities\Factories\MemberFactory;
use Nexus\ChatworkClient\Entities\Factories\MessageFactory;
use Nexus\ChatworkClient\Entities\Factories\RoomFactory;
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

    public function myTask(): MyTaskEndPoint
    {
        return new MyTaskEndPoint($this->client, new TaskFactory());
    }

    public function myStatus(): MyStatusEndPoint
    {
        return new MyStatusEndPoint($this->client, new StatusFactory());
    }

    public function contacts(): ContactsEndPoint
    {
        return new ContactsEndPoint($this->client, new ContactsFactory());
    }

    public function room(): RoomEndPoint
    {
        return new RoomEndPoint($this->client, new RoomFactory());
    }

    public function roomFile(int $roomId): RoomFileEndPoint
    {
        return new RoomFileEndPoint($this->client, new FileFactory(), $roomId);
    }

    public function roomLink(int $roomId): RoomLinkEndPoint
    {
        return new RoomLinkEndPoint($this->client, new LinkFactory(), $roomId);
    }

    public function roomMember(int $roomId): RoomMemberEndPoint
    {
        return new RoomMemberEndPoint($this->client, new MemberFactory(), $roomId);
    }

    public function roomMessage(int $roomId): RoomMessageEndPoint
    {
        return new RoomMessageEndPoint($this->client, new MessageFactory(), $roomId);
    }

    public function roomTask(int $roomId): RoomTaskEndPoint
    {
        return new RoomTaskEndPoint($this->client, new TaskFactory(), $roomId);
    }

    public function incomingRequest(): IncomingRequestsEndPoint
    {
        return new IncomingRequestsEndPoint($this->client, new IncomingRequestFactory());
    }
}
