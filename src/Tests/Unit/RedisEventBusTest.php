<?php
namespace Evilamany\Rates\Tests\Unit;

use Evilamany\Rates\EventBuses\RedisEventBus;
use PHPUnit\Framework\TestCase;

class RedisEventBusTest extends TestCase {
    protected $eventBus;

    public function setUp(): void {
        parent::setUp();

        $this->eventBus = new RedisEventBus([
            'host' => '127.0.0.1',
            'post' => '6379',
            'password' => null,
            'database' => 'rates'
        ]);
    }

    /**public function testPubSub() {
        $originalMsg = 'message';

        $this->eventBus->publish('test', $originalMsg);

        $this->eventBus->subscribe('test', function($message) use ($originalMsg) {
            $this->assertEquals($originalMsg, $message);
            return false;
        });
    }*/
}
