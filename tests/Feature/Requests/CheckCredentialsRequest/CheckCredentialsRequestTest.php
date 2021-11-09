<?php

declare(strict_types=1);

namespace Tests\Feature\Requests\CheckCredentialsRequest;

use Devpark\Transfers24\Requests\CheckCredentialsRequest;
use Devpark\Transfers24\Responses\InvalidResponse;
use Devpark\Transfers24\Responses\TestConnection;
use Mockery\MockInterface;
use Tests\UnitTestCase;

class CheckCredentialsRequestTest extends UnitTestCase
{
    use CheckCredentialsRequestTrait;

    /**
     * @var CheckCredentialsRequest
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

        $this->request = $this->app->make(CheckCredentialsRequest::class);
    }

    /**
     * @feature Connection With Provider
     * @scenario Test Connection
     * @case Connection passed
     *
     * @test
     */
    public function execute_was_call_transfers_provider_test_connection()
    {

        //When
        $response = $this->makeResponse();
        $this->requestTestAccessSuccessful($response);
        $response = $this->request->execute();

        //Then
        $this->assertInstanceOf(TestConnection::class, $response);
        $this->assertSame(200, $response->getCode());
    }

    /**
     * @feature Connection With Provider
     * @scenario Test Connection
     * @case Connection failed
     *
     * @test
     */
    public function execute_was_failed_and_return_invalid_connection()
    {
        //When
        $this->requestTestAccessFailed();
        $response = $this->request->execute();

        //Then
        $this->assertInstanceOf(InvalidResponse::class, $response);
        $this->assertSame(401, $response->getErrorCode());
    }
}
