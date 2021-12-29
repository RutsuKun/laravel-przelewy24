<?php

namespace Tests\Responses;

use Devpark\Transfers24\Contracts\Form;
use Devpark\Transfers24\Responses\Register as ResponseRegister;
use Devpark\Transfers24\Services\DecodedBody;
use Mockery as m;
use Tests\UnitTestCase;

class RegisterTest extends UnitTestCase
{
    /**
     * @var m\MockInterface
     */
    private $decoded_body;

    /**
     * @var m\MockInterface
     */
    private $form;

    /**
     * @var ResponseRegister
     */
    private $response;

    protected function setUp()
    {
        parent::setUp();

        $this->form = m::mock(Form::class);
        $this->decoded_body = m::mock(DecodedBody::class);

        $this->response = new ResponseRegister($this->form, $this->decoded_body);
    }

    /**
     * @feature Online Payments
     * @scenario Register Payment
     * @case It returns Payment Token
     *
     * @test
     */
    public function verified_return_token()
    {
        $token_handler = '123456789';
        $this->decoded_body->shouldReceive('getToken')->andReturn($token_handler);

        $token = $this->response->getToken();
        $this->assertEquals($token, $token_handler);
    }

    /** @test */
    public function check_response_success()
    {
        $this->decoded_body->shouldReceive('getStatusCode')->once()->andReturn(200);

        $success = $this->response->isSuccess();
        $this->assertTrue($success);
    }

    /**
     * @feature Online Payments
     * @scenario Register Payment
     * @case It returns error message
     *
     * @test
     */
    public function check_correct_error_code_passing()
    {
        $code = 4;
        $this->decoded_body->shouldReceive('getStatusCode')->once()->andReturn($code);

        $error_code = $this->response->getErrorCode();
        $this->assertEquals($error_code, $code);
    }

    /**
     * @feature Online Payments
     * @scenario Register Payment
     * @case It returns error message
     *
     * @test
     */
    public function check_correct_error_description_passing()
    {
        $error_description = 'error 1 desc';

        $this->decoded_body->shouldReceive('getErrorMessage')->once()->andReturn($error_description);

        $error_description_passing = $this->response->getErrorDescription();
        $this->assertEquals($error_description_passing, $error_description);
    }

    /**
     * @feature Online Payments
     * @scenario Register Payment
     * @case It returns error message
     *
     * @test
     */
    public function check_correct_request_paramters_passing()
    {
        $parameters_request = [
            'a' => 'a',
            'b' => 'b',
        ];
        $this->form->shouldReceive('toArray')->once()->andReturn($parameters_request);

        $parameters = $this->response->getRequestParameters();
        $this->assertEquals($parameters, $parameters_request);
    }

    /**
     * @feature Connection With Provider - Edited
     * @scenario Test Connection Edited
     * @case Are data from Provider parsed aaaa bb
     *
     * @suite jeden sjut
     * @expectation nic szczegolnego
     *
     * @description nie ma opisu
     *
     * @test
     */
    public function check_correct_session_id_passing_edited()
    {
        $session_id = 4;
        $this->form->shouldReceive('getSessionId')->once()->andReturn($session_id);

        $passing_session_id = $this->response->getSessionId();
        $this->assertEquals($passing_session_id, $session_id);
    }
}
