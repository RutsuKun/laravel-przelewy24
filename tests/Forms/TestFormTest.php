<?php

namespace Tests\Forms;

use Devpark\Transfers24\Forms\TestForm;
use Tests\UnitTestCase;

class TestFormTest extends UnitTestCase
{
    /**
     * @var TestForm
     */
    private $form;

    protected function setUp()
    {
        parent::setUp();

        $this->form = new TestForm();
    }

    /**
     * @Feature Payments
     * @Scenario Test Form
     * @Case get method
     * @test
     */
    public function get_method()
    {
        //When
        $method = $this->form->getMethod();

        //Then
        $this->assertSame('GET', $method);
    }
}
