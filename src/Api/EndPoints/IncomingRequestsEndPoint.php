<?php

declare(strict_types=1);

namespace Nexus\ChatworkClient\Api\EndPoints;

use Illuminate\Support\Collection;
use Nexus\ChatworkClient\Client\ClientInterface;
use Nexus\ChatworkClient\Entities\Factories\IncomingRequestFactory;
use Nexus\ChatworkClient\Entities\IncomingRequest;

class IncomingRequestsEndPoint extends AbstractEndPoint
{
    /**
     * @var IncomingRequestFactory
     */
    protected $factory;

    public function __construct(ClientInterface $client, IncomingRequestFactory $factory)
    {
        parent::__construct($client, $factory);
    }

    /**
     * GET /incoming_requests 自分に対するコンタクト承認依頼一覧を取得する(※100件まで取得可能。今後、より多くのデータを取得する為のページネーションの仕組みを提供予定).
     *
     * @return Collection<IncomingRequest>
     *
     * @see https://developer.chatwork.com/ja/endpoint_incoming_requests.html#GET-incoming_requests
     */
    public function getIncomingRequests(): Collection
    {
        return $this->factory->entitiesAsCollection($this->client->get('incoming_requests'));
    }

    /**
     * PUT /incoming_requests/{request_id} 自分に対するコンタクト承認依頼を承認する.
     *
     * @see https://developer.chatwork.com/ja/endpoint_incoming_requests.html#PUT-incoming_requests-request_id
     */
    public function putIncomingRequests(int $requestId): IncomingRequest
    {
        return $this->factory->entity($this->client->put("incoming_requests/{$requestId}"));
    }

    /**
     * DELETE /incoming_requests/{request_id} 自分に対するコンタクト承認依頼をキャンセルする.
     *
     * @see https://developer.chatwork.com/ja/endpoint_incoming_requests.html#DELETE-incoming_requests-request_id
     */
    public function deleteIncomingRequests(int $requestId): void
    {
        $this->client->delete("incoming_requests/{$requestId}");
    }
}
