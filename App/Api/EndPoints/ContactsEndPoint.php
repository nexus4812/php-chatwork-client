<?php


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

    public function getContacts(): Contacts
    {
        return $this->factory->entity($this->client->get('/contacts'));
    }
}
