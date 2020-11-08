<?php

declare(strict_types=1);

namespace Nexus\ChatworkClient\Api\EndPoints;

use Illuminate\Support\Collection;
use Nexus\ChatworkClient\Client\ClientInterface;
use Nexus\ChatworkClient\Entities\Contacts;
use Nexus\ChatworkClient\Entities\Factories\ContactsFactory;

class ContactsEndPoint extends AbstractEndPoint
{
    /**
     * @var ContactsFactory
     */
    private $factory;

    public function __construct(ClientInterface $client, ContactsFactory $factory)
    {
        parent::__construct($client);
        $this->factory = $factory;
    }

    /**
     * @return array<Contacts>|Collection
     */
    public function getContacts(): Collection
    {
        return $this->factory->entitiesAsCollection($this->client->get('contacts'));
    }
}
