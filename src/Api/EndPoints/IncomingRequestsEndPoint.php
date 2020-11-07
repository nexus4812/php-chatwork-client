<?php

declare(strict_types=1);

namespace ChatWorkClient\Api\EndPoints;

use ChatWorkClient\Client\ClientInterface;
use ChatWorkClient\Entities\Factories\IncomingRequestFactory;
use ChatWorkClient\Entities\IncomingRequest;
use Illuminate\Support\Collection;

class IncomingRequestsEndPoint extends AbstractEndPoint
{
    /**
     * @var IncomingRequestFactory
     */
    private $incomingRequestFactory;

    public function __construct(ClientInterface $client, IncomingRequestFactory $incomingRequestFactory)
    {
        parent::__construct($client);
        $this->incomingRequestFactory = $incomingRequestFactory;
    }

    /**
     * GET /incoming_requests 自分に対するコンタクト承認依頼一覧を取得する(※100件まで取得可能。今後、より多くのデータを取得する為のページネーションの仕組みを提供予定).
     *
     * @return array<IncomingRequest>|Collection
     */
    public function getIncomingRequests(): Collection
    {
        return $this->incomingRequestFactory->entitiesAsCollection($this->client->get('incoming_requests'));
    }

    /**
     * PUT /incoming_requests/{request_id} 自分に対するコンタクト承認依頼を承認する.
     */
    public function putIncomingRequests(int $requestId): IncomingRequest
    {
        return $this->incomingRequestFactory->entity($this->client->put("incoming_requests/{$requestId}"));
    }

    /**
     * DELETE/incoming_requests/{request_id}自分に対するコンタクト承認依頼をキャンセルする.
     */
    public function deleteIncomingRequests(int $requestId): void
    {
        $this->client->put("incoming_requests/{$requestId}");
    }
}
