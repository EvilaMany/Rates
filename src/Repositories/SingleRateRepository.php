<?php
namespace Evilamany\Rates\Repositories;

use Evilamany\Rates\Contracts\RateRepositoryContract;
use Evilamany\Rates\Contracts\RateContract;
use Evilamany\Rates\Facades\RedisFacade;
use Evilamany\Rates\Models\SingleRate\SingleRate;

class SingleRateRepository implements RateRepositoryContract
{
    protected $currency = '';

    /**
     * Set currency which will be used in every method
     *
     * @param string $currency
     */
    public function setCurrency(string $currency) {
        $this->currency = $currency;
    }

    public function __construct($currency = '') {
        $this->currency = $currency;
    }

    /**
     * Save rate at timestamp
     *
     * @param RateContract $rate
     */
    public function updateOrCreate(RateContract $rate) {
        if(!$rate instanceof SingleRate) {
            throw new Exception('Unexpected Rate type');
        }
    }

    public function exists(int $timestamp): bool {
        return RedisFacade::hexists($this->getKey(), $timestamp);
    }

    public function find(int $timestamp): ?SingleRate {
        $rate = RedisFacade::hget($this->getKey(), $timestamp);
        $rate = json_decode($rate);

        $single = new SingleRate($timestamp, $rate['value']);

        return $single;
    }

    private function getKey() {
        return $this->currency;
    }
}
