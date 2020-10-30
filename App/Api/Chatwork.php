<?php


namespace ChatWorkClient\Api;

use ChatWorkClient\Api\EndPoints\ContactsEndPoint;
use ChatWorkClient\Api\EndPoints\IncomingRequestsEndPoint;
use ChatWorkClient\Api\EndPoints\RoomEndPoint;
use ChatWorkClient\Client\ClientFactory;
use ChatWorkClient\Client\ClientInterface;
use ChatWorkClient\Entities\Factories\ContactsFactory;
use ChatWorkClient\Entities\Factories\FileFactory;
use ChatWorkClient\Entities\Factories\IncomingRequestFactory;
use ChatWorkClient\Entities\Factories\LinkFactory;
use ChatWorkClient\Entities\Factories\MemberFactory;
use ChatWorkClient\Entities\Factories\MessageFactory;
use ChatWorkClient\Entities\Factories\MyTaskFactory;
use ChatWorkClient\Entities\Factories\MeFactory;
use ChatWorkClient\Entities\Factories\RoomFactory;
use ChatWorkClient\Entities\Factories\StatusFactory;
use ChatWorkClient\Entities\Factories\TaskFactory;
use ChatWorkClient\Api\EndPoints\MeEndPoint;
use ChatWorkClient\Api\EndPoints\MyEndPoint;

class ChatWork
{
    /**
     * @var ClientInterface
     */
    private $client;


    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    public static function create(string $chatWorkApiToken):self
    {
        return new self((new ClientFactory())->guzzleHttp($chatWorkApiToken));
    }

    public function me(): MeEndPoint
    {
        return (new MeEndPoint($this->client, new MeFactory()));
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
            new RoomFactory(),
            new MemberFactory(),
            new MessageFactory(),
            new TaskFactory(),
            new LinkFactory(),
            new FileFactory()
        );
    }

    public function IncomingRequest():IncomingRequestsEndPoint
    {
        return new IncomingRequestsEndPoint($this->client, new IncomingRequestFactory());
    }
}
