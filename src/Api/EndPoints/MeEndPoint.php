<?php

declare(strict_types=1);

namespace Nexus\ChatworkClient\Api\EndPoints;

use Nexus\ChatworkClient\Client\ClientInterface;
use Nexus\ChatworkClient\Entities\Factories\MeFactory;
use Nexus\ChatworkClient\Entities\Me;

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
        return $this->factory->entity($this->client->get('me'));
    }
}
