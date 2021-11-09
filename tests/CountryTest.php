<?php

namespace Tests;

use Devpark\Transfers24\Country;

class CountryTest extends UnitTestCase
{
    protected function setUp()
    {
        parent::setUp();
    }

    /**
     * @feature Online Payments
     * @scenario Register Payment
     * @case Set User Data
     * 
     * @suite Set User Data
     * @test
     */
    public function set_one_from_avalible_countries()
    {
        $country = 'ANDORRA';
        $pass_country = Country::get($country);
        $this->assertEquals($pass_country, 'AD');

        $country = 'AD';
        $pass_country = Country::get($country);
        $this->assertEquals($pass_country, 'AD');

        $default_country = 'PL';
        $country = 'OTHER';
        $pass_country = Country::get($country);
        $this->assertEquals($pass_country, $default_country);
    }
}
