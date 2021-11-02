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
                'pass_amount' => 12300,
            ],
            [
                'amount' => 123.45,
                'pass_amount' => 12345,
            ],
            [
                'amount' => '123.45',
                'pass_amount' =>  12345,
            ],
            [
                'amount' => '123,45',
                'pass_amount' => 12345,
            ],
            [
                'amount' => 'asdf',
                'pass_amount' => 0,
            ],
            [
                'amount' => '0,01',
                'pass_amount' => 1,
            ],
            [
                'amount' => 001,
                'pass_amount' => 100,
            ],
            [
                'amount' => 001.11,
                'pass_amount' => 111,
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
    public function check_correct_normalize_amount($amount, $expected)
    {
        $pass_amount = Amount::get($amount);
        $this->assertEquals($pass_amount, $expected);
    }
}
