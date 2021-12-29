<?php

namespace Tests\Services;

use Devpark\Transfers24\CodeTranslate;
use Tests\UnitTestCase;

class CodeTranslateTest extends UnitTestCase
{
    protected function setUp()
    {
        parent::setUp();
    }

    /**
     * @feature Online Payments
     * @scenario Register Payment
     * @case Are entry data validated
     *
     * @suite Data Validation
     * @test
     */
    public function is_correct_code_array()
    {
        $codes = [
            'CODE' => '-1',
        ];

        $avalable_codes = CodeTranslate::getCodes();

        $this->assertEquals($avalable_codes, $codes);
    }

    /**
     * @suite set user data - edited suite
     * @feature Online Payments
     * @scenario Register Payment
     * @case It set entry Data
     *
     * @test
     */
    public function set_one_from_avalible_codes()
    {
        $default_code = '999';

        $code = '-1';
        $pass_code = CodeTranslate::getCode($code, $default_code);
        $this->assertEquals($pass_code, $code);

        $code = 'CODE';
        $pass_code = CodeTranslate::getCode($code, $default_code);
        $this->assertEquals($pass_code, '-1');

        $code = 'code';
        $pass_code = CodeTranslate::getCode($code, $default_code);
        $this->assertEquals($pass_code, '-1');

        $code = '111';
        $pass_code = CodeTranslate::getCode($code, $default_code);
        $this->assertEquals($pass_code, $default_code);
    }
}
