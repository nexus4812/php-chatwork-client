<?php

declare(strict_types=1);

namespace Nexus\ChatworkClient\Api\EndPoints;

use Nexus\ChatworkClient\Client\ClientInterface;
use Nexus\ChatworkClient\Entities\Factories\StatusFactory;
use Nexus\ChatworkClient\Entities\Status;

class MyStatusEndPoint extends AbstractEndPoint
{
    /**
     * @var StatusFactory
     */
    protected $factory;

    public function __construct(ClientInterface $client, StatusFactory $factory)
    {
        parent::__construct($client, $factory);
    }

    public function getStatus(): Status
    {
        return $this->factory->entity($this->client->get('my/status'));
    }
}
