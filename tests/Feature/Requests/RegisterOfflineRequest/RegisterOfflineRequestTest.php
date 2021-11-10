<?php

declare(strict_types=1);

namespace Tests\Feature\Requests\RegisterOfflineRequest;

use Devpark\Transfers24\Requests\RegisterOfflineRequest;
use Devpark\Transfers24\Responses\InvalidResponse;
use Devpark\Transfers24\Responses\RegisterOfflineResponse;
use Mockery\MockInterface;
use Tests\UnitTestCase;

class RegisterOfflineRequestTest extends UnitTestCase
{
    use RegisterOfflineRequestTrait;

    /**
     * @var RegisterOfflineRequest
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

        $this->request = $this->app->make(RegisterOfflineRequest::class);
    }

    /**
     * @feature Offline Payments
     * @scenario Register Payment
     * @case Offline Payment was started
     *
     * @test
     */
    public function it_gets_successful_status()
    {
        $response = $this->makeResponse();

        $token = 'token';
        $this->requestGettingRegisterOfflineSuccessful($response, $token);
        $response = $this->request->setToken($token)->execute();

        $this->assertInstanceOf(RegisterOfflineResponse::class, $response);
        $this->assertSame(200, $response->getCode());
    }

    /**
     * @feature Offline Payments
     * @scenario Register Payment
     * @case It returns Invalid data when unknown token
     *
     * @test
     */
    public function it_gets_empty_transaction()
    {
        $token = 'unknown-token';
        $this->requestGettingRegisterOfflineNotFound($token);
        $this->request->setToken($token);
        $response = $this->request->execute();
        $this->assertInstanceOf(InvalidResponse::class, $response);
    }

    /**
     * @feature Offline Payments
     * @scenario Register Payment
     * @case It returns offline Payment Info
     *
     * @test
     */
    public function it_gets_transaction_details()
    {
        $response = $this->makeResponse();
        $offline_payment = $this->makeRegisterOffline();

        $token = 'token';
        $this->requestGettingRegisterOfflineSuccessful($response, $token);
        $this->request->setToken($token);
        $response = $this->request->execute();

        $this->assertInstanceOf(RegisterOfflineResponse::class, $response);

        $this->assertSame($offline_payment->orderId, $response->getOffline()->orderId);
        $this->assertSame($offline_payment->sessionId, $response->getOffline()->sessionId);
        $this->assertSame($offline_payment->amount, $response->getOffline()->amount);
        $this->assertSame($offline_payment->statement, $response->getOffline()->statement);
        $this->assertSame($offline_payment->iban, $response->getOffline()->iban);
        $this->assertSame($offline_payment->ibanOwner, $response->getOffline()->ibanOwner);
        $this->assertSame($offline_payment->ibanOwnerAddress, $response->getOffline()->ibanOwnerAddress);
    }

    /**
     * @feature Offline Payments
     * @scenario Register Payment
     * @case It returns Invalid data when authentication failed
     *
     * @test
     */
    public function execute_was_failed_and_return_invalid_response()
    {
        $token = 'token';
        $this->requestRegisterOfflineFailed($token);
        $response = $this->request->setToken($token)->execute();

        $this->assertInstanceOf(InvalidResponse::class, $response);
        $this->assertSame(401, $response->getErrorCode());
    }
}
