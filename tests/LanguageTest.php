<?php

namespace Tests;

use Devpark\Transfers24\Language;

class LanguageTest extends UnitTestCase
{
    protected function setUp()
    {
        parent::setUp();
    }

    /**
     * @feature Online Payments
     * @scenario Register Payment
     * @case It set entry Data
     *
     * @suite Set User Data
     * @test
     */
    public function set_one_from_avalible_language()
    {
        $language = 'ENGLISH';
        $pass_language = Language::get($language);
        $this->assertEquals($pass_language, 'en');

        $language = 'en';
        $pass_language = Language::get($language);
        $this->assertEquals($pass_language, 'en');

        $default_language = 'pl';
        $language = 'other';
        $pass_language = Language::get($language);
        $this->assertEquals($pass_language, $default_language);

        $language = 'english';
        $pass_language = Language::get($language);
        $this->assertEquals($pass_language, 'en');
    }
}
