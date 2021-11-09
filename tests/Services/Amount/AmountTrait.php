<?php

namespace Tests\Services\Amount;

trait AmountTrait
{

    public function provideAmount()
    {
        return [
            ['amount' => 1.11, 'expected' => 111],
            ['amount' => 123.45, 'expected' => 12345],
            ['amount' => '123.45', 'expected' => 12345],
            ['amount' => '123,45', 'expected' => 12345],
            ['amount' => 'asdf', 'expected' => 0],
            ['amount' => '0,01', 'expected' => 1],
            ['amount' => 1, 'expected' => 100],
            ['amount' => 99.99, 'expected' => 9999],
            ['amount' => 0.99, 'expected' => 99],
        ];
    }
}
