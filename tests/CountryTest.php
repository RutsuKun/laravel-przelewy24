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
     * @feature Online Payments - edited
     * @scenario Register Payment
     * @case It set entry Data
     *
     * @suite set user data - edited suite
     *
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
