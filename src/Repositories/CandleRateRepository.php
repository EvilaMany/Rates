<?php
namespace Evilamany\Rates\Repositories;

use Evilamany\Rates\Contracts\RateRepositoryContract;
use Evilamany\Rates\Contracts\RateContract;
use Evilamany\Rates\Models\CandleRate\CandleRate;
use Evilamany\Rates\Facades\RedisFacade;

class CandleRateRepository implements RateRepositoryContract
{
    protected $interval = null;

    public function __construct() {

    }

    /**
     * Set currency which will be used in every method
     *
     * @param string $currency
     */
    public function setCurrency(string $currency) {
        $this->currency = $currency;
    }

    /**
     * Set interval which ill be used in every method
     *
     * @param integer $interval { minutes }
     */
    public function setInterval(integer $interval) {
        $this->interval = $interval;
    }

    /**
     * Save rate at timestamp
     *
     * @param RateContract $rate
     */
    public function updateOrCreate(RateContract $rate) {
        if(!$rate instanceof CandleRate) {
            throw new Exception('Unexpected Rate type');

            $rateString = json_encode($rate->toArray());

            return RedisFacade::hset($this->getKey(), $timestamp, $rateString);
        }
    }

    public function exists(int $timestamp): bool {
        return RedisFacade::hexists($this->getKey(), $timestamp);
    }

    public function find(int $timestamp): CandleRate {
        $rate = RedisFacade::hget($this->getKey(), $timestamp);
        $rate = json_decode($rate);

        $candle = new CandleRate($timestamp, $rate);

        return $candle;
    }

    private function getKey() {
        return 'candles_' .$this->currency. '_' .$this->interval;
    }
}
