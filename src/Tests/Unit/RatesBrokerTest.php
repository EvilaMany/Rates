<?php
namespace Evilamany\Rates\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Evilamany\Rates\RatesBroker;

class RatesBrokerTest extends TestCase
{
    private $ratesBroker;

    public function setUp(): void {
        $this->ratesBroker = new RatesBroker;
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $this->assertTrue($this->ratesBroker instanceof RatesBroker);
    }
}
