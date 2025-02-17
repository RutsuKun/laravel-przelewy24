<?php

namespace Tests;

use Devpark\Transfers24\Currency;
use Devpark\Transfers24\Exceptions\CurrencyException;

class CurrencyTest extends UnitTestCase
{
    protected function setUp()
    {
        parent::setUp();
    }

    /**
     * @feature Online Payments - edited
     * @scenario Register Payment
     * @case Are entry data validated
     *
     * @suite Data Validation
     * @test
     */
    public function is_correct_array_if_currencies()
    {
        $currencies = [
            'PLN' => 'PLN',
            'EUR' => 'EUR',
            'GBP' => 'GBP',
            'CZK' => 'CZK',
            'DKK' => 'DKK',

        ];

        $available_currencies = Currency::getCurrencies();
        $this->assertEquals($available_currencies, $currencies);
    }

    /**
     * @feature Online Payments - edited
     * @scenario Register Payment
     * @case It set entry Data
     *
     * @suite set user data - edited suite
     *
     * @test
     */
    public function set_one_from_available_currencies()
    {
        $currency = 'GBP';
        $pass_currency = Currency::get($currency);
        $this->assertEquals($pass_currency, $currency);

        $currency = 'AED';
        try {
            Currency::get($currency);
        } catch (\Exception $e) {
            $this->assertInstanceOf(CurrencyException::class, $e);
        }
    }
}
