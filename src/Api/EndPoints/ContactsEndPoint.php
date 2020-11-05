<?php

declare(strict_types=1);

namespace ChatWorkClient\Api\EndPoints;

use ChatWorkClient\Client\ClientInterface;
use ChatWorkClient\Entities\Contacts;
use ChatWorkClient\Entities\Factories\ContactsFactory;

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
     * @return array<Contacts>
     */
    public function getContacts(): array
    {
        return $this->factory->entities($this->client->get('contacts'));
    }
}
