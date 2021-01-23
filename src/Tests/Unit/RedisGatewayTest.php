<?php
namespace Evilamany\Rates\Tests\Unit;

use Evilamany\Rates\Gateways\RedisGateway;
use PHPUnit\Framework\TestCase;

class RedisGatewayTest extends TestCase {
    protected $gateway;

    public function setUp(): void {
        parent::setUp();

        $this->gateway = new RedisGateway([
            'host' => '127.0.0.1',
            'post' => '6379',
            'password' => null,
            'database' => 'rates'
        ]);
    }

    public function testHSetGet() {
		$value = 'value';
		$this->gateway->hset('key', 'field', $value);
		
		$newVal = $this->gateway->hget('key', 'field');

		$this->assertEquals($value, $newVal);
    }
}
