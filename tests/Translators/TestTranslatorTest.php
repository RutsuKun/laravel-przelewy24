<?php

namespace Tests\Translators;

use Devpark\Transfers24\Credentials;
use Devpark\Transfers24\Services\Crc;
use Devpark\Transfers24\Translators\RegisterTranslator;
use Devpark\Transfers24\Translators\TestTranslator;
use Illuminate\Config\Repository as Config;
use Mockery as m;
use Tests\UnitTestCase;

class TestTranslatorTest extends UnitTestCase
{
    /**
     * @var m\Mock
     */
    private $credentials;

    /**
     * @var RegisterTranslator
     */
    private $translator;

    /**
     * @var m\MockInterface
     */
    private $crc;

    /**
     * @var m\MockInterface
     */
    private $config;

    protected function setUp()
    {
        parent::setUp();

        $this->crc = m::mock(Crc::class);

        $this->config = m::mock(Config::class);

        $this->translator = $this->app->make(TestTranslator::class, [
            'crc' => $this->crc,
            'config' => $this->config,
        ]);
        $this->credentials = m::mock(Credentials::class);
        $this->translator->init($this->credentials);
    }

    /**
     * @feature Connection With Provider
     * @scenario Test Connection
     * @case Are data from Provider parsed
     * 
     * @test
     */
    public function translate_edited()
    {
        //Given
        $p24_merchant_id = 'merchant-id';
        $p24_pos_id = 'pos-id';

        //When

        $this->config->shouldReceive('get')
            ->times(4)
            ->andReturn(false, $p24_pos_id, $p24_merchant_id, null);

        $this->translator->configure();
        $form = $this->translator->translate();

        $data = $form->toArray();
        $this->assertEmpty($data);
    }
}
