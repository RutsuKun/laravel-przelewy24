<?php

declare(strict_types=1);

namespace Tests\Feature\Requests\RefundRequest;

use Devpark\Transfers24\Contracts\Refund;
use Devpark\Transfers24\Requests\RefundRequest;
use Devpark\Transfers24\Responses\InvalidResponse;
use Devpark\Transfers24\Responses\RefundResponse;
use Mockery\MockInterface;
use Tests\UnitTestCase;

class RefundRequestTest extends UnitTestCase
{
    use RefundRequestTrait;

    /**
     * @var RefundRequest
     */
    private $request;

    /**
     * @var MockInterface
     */
    private $client;

    protected function setUp()
    {
        parent::setUp();

        $this->mockApi();

        $this->setConfiguration();

        $this->request = $this->app->make(RefundRequest::class);
    }

    /**
     * @feature Refunds
     * @scenario Init Refund
     * @case Refund was started
     *
     * @test
     */
    public function refund_was_started_it_get_success_code()
    {
        //Given
        $refund_inquiry = $this->makeRefundQuery();
        $refund_query_raw = $refund_inquiry->toArray();

        //Then
        $this->thenRequestRefundSuccessful($refund_inquiry);

        //When
        $response = $this->request
            ->addRefundInquiry($refund_query_raw['orderId'], $refund_query_raw['sessionId'], $refund_query_raw['amount'], $refund_query_raw['description'])
            ->execute();

        //Then
        $this->assertInstanceOf(RefundResponse::class, $response);
        $this->assertSame(201, $response->getCode());
    }

    /**
     * @feature Refunds
     * @scenario Init Refund
     * @case It gets Refunds Collection
     *
     * @test
     */
    public function it_gets_refunds_collection()
    {
        //Given
        $refund_inquiry = $this->makeRefundQuery();
        $refund_query_raw = $refund_inquiry->toArray();

        //Then
        $this->thenRequestRefundSuccessful($refund_inquiry);

        //When
        $response = $this->request
            ->addRefundInquiry($refund_query_raw['orderId'], $refund_query_raw['sessionId'], $refund_query_raw['amount'], $refund_query_raw['description'])
            ->execute();

        //Then
        $this->assertSame($refund_query_raw['orderId'], $response->getRefunds()[0]->orderId);
        $this->assertSame($refund_query_raw['sessionId'], $response->getRefunds()[0]->sessionId);
        $this->assertSame($refund_query_raw['amount'], $response->getRefunds()[0]->amount);
        $this->assertSame($refund_query_raw['description'], $response->getRefunds()[0]->description);
    }

    /**
     * @feature Refunds
     * @scenario Init Refund
     * @case It rejected because authorization failed
     *
     * @test
     */
    public function execute_was_failed_and_return_invalid_response()
    {
        //Given
        $this->requestRefundFailed();

        //When
        $response = $this->request->execute();

        //Then
        $this->assertInstanceOf(InvalidResponse::class, $response);
        $this->assertSame(401, $response->getErrorCode());
    }
}
