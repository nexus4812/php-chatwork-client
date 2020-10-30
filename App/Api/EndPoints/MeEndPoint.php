<?php


namespace ChatWorkClient\Api\EndPoints;

use ChatWorkClient\Client\ClientInterface;
use ChatWorkClient\Entities\Factories\MeFactory;
use ChatWorkClient\Entities\Me;

class MeEndPoint extends AbstractEndPoint
{
    /**
     * @var MeFactory
     */
    private $factory;

    public function __construct(ClientInterface $client, MeFactory $factory)
    {
        parent::__construct($client);
        $this->factory = $factory;
    }

    public function getMe(): Me
    {
        return $this->factory->entity($this->client->get('/me'));
    }
}
