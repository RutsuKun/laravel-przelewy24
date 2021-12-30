<?php

namespace Tests\Forms;

use Devpark\Transfers24\Forms\RegisterForm;
use Tests\UnitTestCase;

class RegisterFormTest extends UnitTestCase
{
    /**
     * @var RegisterForm
     */
    private $form;

    protected function setUp()
    {
        parent::setUp();

        $this->form = new RegisterForm();
    }

    /**
     * @feature Online Payments - edited
     * @scenario Register Payment
     * @case Is `POST` request type called for connection test
     *
     * @test
     */
    public function get_method()
    {
        //When
        $method = $this->form->getMethod();

        //Then
        $this->assertSame('POST', $method);
    }

    /**
     * @feature Online Payments - edited
     * @scenario Register Payment
     * @case Is correct Url called for Register Payment
     *
     * @test
     */
    public function get_uri()
    {
        //When
        $method = $this->form->getUri();

        //Then
        $this->assertSame('transaction/register', $method);
    }
}
