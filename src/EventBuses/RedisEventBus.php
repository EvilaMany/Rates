<?php
namespace Evilamany\Rates\EventBuses;

use Evilamany\Rates\Contracts\EventBusContract;
use Evilamany\Rates\Models\RawRate\RawRate;
use Evilamany\Rates\Models\SingleRate\SingleRate;
use Evilamany\Rates\Models\CandleRate\CandleRate;
use Evilamany\Rates\Gateways\RedisGateway;

class RedisEventBus implements EventBusContract
{
    protected $connection = null;

    public function __construct(array $config = []) {
        $this->connection = new RedisGateway;
        $this->connection->setConnection($config);
    }

    //TODO write implementation via REDIS connection
    public function publish(string $event, string $message): bool {
        $this->connection->publish($event, $message);

        return true;
    }

    public function subscribe(string $event, Callable $callback) {
        $this->connection->subscribe($event, function($type, $channel, $message) use($callback) {
            if($type === 'message') {
                return $callback($message, $channel);
            }
        });

        return true;
    }

    public function publishRateRelised(RawRate $rate): bool {
        return $this->publish('rate.relised', json_encode($rate->toArray()));
    }

    public function publishSingleUpdated(SingleRate $rate): bool {
        return $this->publish('single.updated', json_encode($rate->toArray()));
    }

    public function publishCandleUpdated(CandleRate $rate): bool {
        return $this->publish('candle.updated', json_encode($rate->toArray()));
    }

    public function onRateRelised(Callable $callback) {

    }

    public function onCandleUpdated(Callable $callback) {

    }

    public function onSingleUpdated(Callable $callback) {

    }
}
