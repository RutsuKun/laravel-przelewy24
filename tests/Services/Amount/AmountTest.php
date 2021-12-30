<?php

namespace Tests\Services\Amount;

use Devpark\Transfers24\Services\Amount;
use Tests\UnitTestCase;

class AmountTest extends UnitTestCase
{
    use AmountTrait;

    protected function setUp()
    {
        parent::setUp();

        $this->amount = new Amount();
    }

    /**
     * @feature Online Payments - edited
     * @scenario Register Payment
     * @case It set entry Data
     *
     * @expectation Unvalidated data data provider.
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
