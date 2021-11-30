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
     * @feature Connection With Provider - Edited
     * @scenario Test Connection Edited
     * @case Is `GET` request type called for connection test
     *
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
