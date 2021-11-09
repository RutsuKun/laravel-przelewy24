<?php

namespace Tests;

use Devpark\Transfers24\Services\Crc;
use Devpark\Transfers24\Services\HashWrapper;

class CrcTest extends UnitTestCase
{
    /**
     * @var Crc
     */
    private $crc;

    /**
     * @var string
     */
    private $salt;

    /**
     * @var \Mockery\MockInterface|HashWrapper
     */
    private $hash;

    protected function setUp()
    {
        parent::setUp();

        $this->salt = 'salt';
        $this->hash = \Mockery::mock(HashWrapper::class);
        $this->crc = new Crc($this->hash);
        $this->crc->setSalt($this->salt);
    }

    /**
     * @feature Online Payments
     * @scenario Register Payment
     * @case Calculate Crc for Payment Form
     *
     * @test
     */
    public function test_calculate_CRC_sum()
    {

        //Given
        $keys = [
            'a',
            'b',
        ];
        $values = [
            'a' => '123456789',
            'b' => 'abcd',
        ];

        //Then
        $expected_crc = $this->expectedCrc($keys, $values);
        $this->hash->shouldReceive('hash')
            ->once()
            ->with($expected_crc);

        //When
        $crc = $this->crc->sum($keys, $values);
    }

    /**
     * @feature Online Payments
     * @scenario Register Payment
     * @case Calculate Crc without salt for Payment Form
     *
     * @test
     */
    public function test_calculate_CRC_sum_without_salt()
    {

        //Given
        $keys = [
            'a',
            'b',
        ];
        $values = [
            'a' => '123456789',
            'b' => 'abcd',
        ];

        //When
        $this->salt = '';
        $this->crc->setSalt($this->salt);

        //Then
        $expected_crc = $this->expectedCrc($keys, $values);
        $this->hash->shouldReceive('hash')
            ->once()
            ->with($expected_crc);

        $crc = $this->crc->sum($keys, $values);
    }

    /**
     * @feature Online Payments
     * @scenario Register Payment
     * @case Calculate Crc with empty data for Payment Form
     *
     * @test
     */
    public function test_return_null_after_calculate_CRC_with_empty_value()
    {

        //Given
        $keys = [
            'a',
            'b',
        ];
        $values = [];

        //When
        $crc = $this->crc->sum($keys, $values);

        //Then
        $this->assertEmpty($crc);
    }

    /**
     * @param array $crc_array
     * @return string
     */
    private function expectedCrc(array $keys, array $values): array
    {
        $crc_array = array_combine($keys, $values);
        if (! empty($this->salt)) {
            $crc_array += ['crc' => $this->salt];
        }

        return $crc_array;
    }
}
