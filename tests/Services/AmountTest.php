<?php

namespace Tests\Services;

use Devpark\Transfers24\Services\Amount;
use Tests\UnitTestCase;

class CountryTest extends UnitTestCase
{
    public function provideAmount()
    {
        return [
            [
                'amount' => 123,
                'expected' => 12300,
            ],
            [
                'amount' => 123.45,
                'expected' => 12345,
            ],
            [
                'amount' => '123.45',
                'expected' =>  12345,
            ],
            [
                'amount' => '123,45',
                'expected' => 12345,
            ],
            [
                'amount' => 'asdf',
                'expected' => 0,
            ],
            [
                'amount' => '0,01',
                'expected' => 1,
            ],
            [
                'amount' => 001,
                'expected' => 100,
            ],
            [
                'amount' => 001.11,
                'expected' => 111,
            ],
        ];
    }

    protected function setUp()
    {
        parent::setUp();

        $this->amount = new Amount();
    }

    /**
     * @feature Payments
     * @Scenario Register Payment
     * @case Set Payment Amount
     * @test
     * @dataProvider provideAmount
     *
     */
    public function check_correct_normalize_amount($amount, $expected_amount)
    {
        $pass_amount = Amount::get($amount);
        $this->assertEquals($pass_amount, $expected_amount);
    }
}
