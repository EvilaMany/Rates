<?php
namespace Evilamany\Rates\Tests\Unit;

use Evilamany\Rates\RateProviders\CoincapRateProvider;
use Evilamany\Rates\EventBuses\RedisEventBus;
use PHPUnit\Framework\TestCase;

class CoincapRatesProviderTest extends TestCase {
    protected $object;

    public function setUp(): void {
        parent::setUp();

        $eventBus = new RedisEventBus([
            'host' => '127.0.0.1',
            'post' => '6379',
            'password' => '',
            'db_name' => 'rates'
        ]);

        $this->object = new CoincapRateProvider($eventBus);
    }

    public function testSetCurrencies() {
        $this->object->setCurrencies(['bitcoin', 'ruble', 'litecoin']);
        $currencies = $this->object->getCurrencies();

        $this->assertEquals(count($currencies), 2);
    }


    /**
     * @depends testSetCurrencies
     */
    public function estRunning() {
        $this->object->run();
    }

}
