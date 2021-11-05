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
     * @feature Payments
     * @scenario Register Form
     * @case It get Form Method
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
     * @feature Payments
     * @scenario Register Form
     * @case It get Form Url
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
