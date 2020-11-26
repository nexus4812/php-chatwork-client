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
    protected $factory;

    public function __construct(ClientInterface $client, MeFactory $factory)
    {
        parent::__construct($client, $factory);
    }

    /**
     * GET /me 自分自身の情報を取得
     *
     * @see https://developer.chatwork.com/ja/endpoint_me.html#GET-me
     */
    public function getMe(): Me
    {
        return $this->factory->entity($this->client->get('me'));
    }
}
