<?php

declare(strict_types=1);

namespace Tests\Feature\Requests\TransactionRequest;

use Devpark\Transfers24\Requests\TransactionRequest;
use Devpark\Transfers24\Responses\InvalidResponse;
use Devpark\Transfers24\Responses\TransactionResponse;
use Mockery\MockInterface;
use Tests\UnitTestCase;

class TransactionRequestTest extends UnitTestCase
{
    use TransactionRequestTrait;

    /**
     * @var TransactionRequest
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

        $this->request = $this->app->make(TransactionRequest::class);
    }

    /**
     * @feature Online Payments
     * @scenario Get Payment Info
     * @case It gets Payment Info by Session Identifier
     *
     * @test
     */
    public function it_gets_successful_status()
    {
        $response = $this->makeResponse();

        $this->requestGettingTransactionSuccessful($response, 'session-id');
        $response = $this->request->setSessionId('session-id')->execute();

        $this->assertInstanceOf(TransactionResponse::class, $response);
        $this->assertSame(200, $response->getCode());
    }

    /**
     * @feature Online Payments
     * @scenario Get Payment Info
     * @case It return empty data when not found transaction
     *
     * @test
     */
    public function it_gets_empty_transaction()
    {

//        $response = $this->makeResponse();

        $session_id = 'known-session-id';
        $this->requestGettingTransactionNotFound($session_id);
        $this->request->setSessionId($session_id);
        $response = $this->request->execute();
        $this->assertInstanceOf(InvalidResponse::class, $response);
//        $this->assertSame(404, $response->getErrorCode());
    }

    /**
     * @feature Online Payments
     * @scenario Get Payment Info
     * @case It gets Payment Info by Session Identifier
     *
     * @test
     */
    public function it_gets_transaction_details()
    {
        $response = $this->makeResponse();

        $transaction = $this->makeTransaction();

        $this->requestGettingTransactionSuccessful($response, 'session-id');
        $this->request->setSessionId('session-id');
        $response = $this->request->execute();

        $this->assertInstanceOf(TransactionResponse::class, $response);

        $this->assertSame($transaction->orderId, $response->getTransaction()->orderId);
        $this->assertSame($transaction->sessionId, $response->getTransaction()->sessionId);
        $this->assertSame($transaction->status, $response->getTransaction()->status);
        $this->assertSame($transaction->amount, $response->getTransaction()->amount);
        $this->assertSame($transaction->currency, $response->getTransaction()->currency);
        $this->assertSame($transaction->date, $response->getTransaction()->date);
        $this->assertSame($transaction->dateOfTransaction, $response->getTransaction()->dateOfTransaction);
        $this->assertSame($transaction->clientEmail, $response->getTransaction()->clientEmail);
        $this->assertSame($transaction->accountMD5, $response->getTransaction()->accountMD5);
        $this->assertSame($transaction->paymentMethod, $response->getTransaction()->paymentMethod);
        $this->assertSame($transaction->description, $response->getTransaction()->description);
        $this->assertSame($transaction->clientName, $response->getTransaction()->clientName);
        $this->assertSame($transaction->clientAddress, $response->getTransaction()->clientAddress);
        $this->assertSame($transaction->clientCity, $response->getTransaction()->clientCity);
        $this->assertSame($transaction->clientPostcode, $response->getTransaction()->clientPostcode);
        $this->assertSame($transaction->batchId, $response->getTransaction()->batchId);
        $this->assertSame($transaction->fee, $response->getTransaction()->fee);
    }

    /**
     * @feature Online Payments
     * @scenario Get Payment Info
     * @case It return invalid data when authentication failed
     *
     * @test
     */
    public function execute_was_failed_and_return_invalid_response()
    {
        $this->requestTestAccessFailed();
        $response = $this->request->setSessionId('session-id')->execute();

        $this->assertInstanceOf(InvalidResponse::class, $response);
        $this->assertSame(401, $response->getErrorCode());
    }
}
