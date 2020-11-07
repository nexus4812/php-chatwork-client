<?php

declare(strict_types=1);

namespace ChatWorkClient\Api\EndPoints;

use ChatWorkClient\Client\ClientInterface;
use ChatWorkClient\Entities\Contacts;
use ChatWorkClient\Entities\Factories\ContactsFactory;
use Illuminate\Support\Collection;

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
