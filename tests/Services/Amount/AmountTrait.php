<?php

namespace Tests\Services\Amount;

trait AmountTrait
{

    public function provideAmount()
    {
        return [
            '0' => ['amount' => 1.11, 'expected' => 111], // test passed
            '1' => ['amount' => 123.45, 'expected' => 12345], // test passed
            '2' => ['amount' => '123.45', 'expected' => 12345], // test passed
            '3' => ['amount' => '123,45', 'expected' => 12345], // test passed
            '4' => ['amount' => 'asdf', 'expected' => 0], // test passed
            '5' => ['amount' => '0,01', 'expected' => 1], // test passed
            '6' => ['amount' => 1, 'expected' => 100], // test passed
            '7' => ['amount' => 99.99, 'expected' => 9999], // test passed
            '8' => ['amount' => 0.99, 'expected' => 99], // test passed
            '9' => ['amount' => 999.99, 'expected' => 99999], // test passed
            '10' => ['amount' => 'asd', 'expected' => 1], // test failed
        ];
    }
}
