<?php

namespace Tests\Services\Amount;

trait AmountTrait
{

    public function provideAmount()
    {
        return [
            '7' => ['amount' => 1.11, 'expected' => 111],
            '1' => ['amount' => 123.45, 'expected' => 12345],
            '2' => ['amount' => '123.45', 'expected' => 12345],
            '3' => ['amount' => '123,45', 'expected' => 12345],
            '4' => ['amount' => 'asdf', 'expected' => 0],
            '5' => ['amount' => '0,01', 'expected' => 1],
            '6' => ['amount' => 1, 'expected' => 100],
            '9999' => ['amount' => 99.99, 'expected' => 9999],
            '9' => ['amount' => 0.99, 'expected' => 99],
        ];
    }
}
