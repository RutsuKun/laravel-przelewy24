<?php

namespace Tests\Forms;

use Devpark\Transfers24\Forms\ReceiveForm;
use Tests\UnitTestCase;

class ReceiveFormTest extends UnitTestCase
{
    /**
     * @var ReceiveForm
     */
    private $form;

    protected function setUp()
    {
        parent::setUp();

        $this->form = new ReceiveForm();
    }

    /**
     * @feature Payment Verification
     * @scenario Verify Payment
     * @case Is `PUT` request type called for verifying Payment
     *
     * @test
     */
    public function get_method()
    {
        //When
        $method = $this->form->getMethod();

        //Then
        $this->assertSame('PUT', $method);
    }

    /**
     * @feature Payment Verification
     * @scenario Verify Payment
     * @case Is corrected Url called for Payment verification
     *
     * @test
     */
    public function get_uri()
    {
        //When
        $method = $this->form->getUri();

        //Then
        $this->assertSame('transaction/verify', $method);
    }
}
