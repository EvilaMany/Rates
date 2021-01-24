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

	public function __construct(RedisGateway $connection) {
        $this->connection = $connection;
    }



	/**
	 * Undocumented function
	 *
	 * @param string $event
	 * @param string $message
	 * @return boolean
	 */
    public function publish(string $event, string $message = ''): bool {
        //print($event . ' ' . $message . "\n");
        $this->connection->publish($event, $message);

        return true;
    }

	/**
	 * Undocumented function
	 *
	 * @param string $event
	 * @param Callable $callback
	 * @return void
	 */
    public function subscribe(string $event, Callable $callback) {
        $this->connection->subscribe($event, function($type, $channel, $message) use($callback) {
            return $callback($message, $channel);
        });
    }


	/**
	 * Undocumented function
	 *
	 * @param RawRate $rate
	 * @return boolean
	 */
    public function publishRateRelised(RawRate $rate): bool {
        return $this->publish('rate.relised', json_encode($rate->toArray()));
    }

	/**
	 * Undocumented function
	 *
	 * @param SingleRate $rate
	 * @return boolean
	 */
    public function publishSingleUpdated(SingleRate $rate): bool {
        return $this->publish('single.updated', json_encode($rate->toArray()));
    }

	/**
	 * Undocumented function
	 *
	 * @param CandleRate $rate
	 * @return boolean
	 */
    public function publishCandleUpdated(CandleRate $rate): bool {
        return $this->publish('candle.updated', json_encode($rate->toArray()));
    }

	/**
	 * Undocumented function
	 *
	 * @param Callable $callback
	 * @return void
	 */
    public function onRateRelised(Callable $callback) {
		$this->subscribe('rate.relised', function($message, $channel) use($callback) {
			$info = json_decode($message, 1);

			$rate = new RawRate($info['timestamp'], $info['currency'], $info['value']);

			$callback($rate);
		});
    }

	/**
	 * Undocumented function
	 *
	 * @param Callable $callback
	 * @return void
	 */
    public function onCandleUpdated(Callable $callback) {
		$this->subscribe('candle.updated', function($message, $channel) use($callback) {
			$info = json_decode($message, 1);

			$rate = new SingleRate(
				$message['timestamp'],
				$message['currency'],
				(integer) $message['value']
			);

			$callback($rate);
		});
    }

	/**
	 * Undocumented function
	 *
	 * @param Callable $callback
	 * @return void
	 */
    public function onSingleUpdated(Callable $callback) {
		$this->subscribe('single.updated', function($message, $channel) use($callback) {
			$info = json_decode($message);

			$rate = new CandleRate(
				$message['timestamp'],
				$message['currency'],
				$message['values']
			);

			$callback($rate);
		});
    }
}
