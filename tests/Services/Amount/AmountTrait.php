<?php

namespace Tests\Services\Amount;

trait AmountTrait
{

    public function provideAmount()
    {
        return [
            '0' => ['amount' => 1.11, 'expected' => 111],
            '1' => ['amount' => 123.45, 'expected' => 12345],
            '2' => ['amount' => '123.45', 'expected' => 12345],
            '3' => ['amount' => '123,45', 'expected' => 12345],
            '4' => ['amount' => 'asdf', 'expected' => 0],
            '5' => ['amount' => '0,01', 'expected' => 1],
            '6' => ['amount' => 1, 'expected' => 100],
            '7' => ['amount' => 99.99, 'expected' => 9999],
            '8' => ['amount' => 0.99, 'expected' => 99],
            '9' => ['amount' => 999.99, 'expected' => 99999],
            '10' => ['amount' => 'asd', 'expected' => 1],
            '11' => ['amount' => 'asdasd', 'expected' => 2],
        ];
    }
}
