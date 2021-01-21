<?php
namespace Evilamany\Rates;

use Evilamany\RatesProducer;

use Evilamany\Contracts\CurrencyRepositoryContract;
use Evilamany\Repositories\BitcoinRepository;
use Evilamany\Repositories\LitecoinRepository;

class RatesBroker
{
    private $bitcoinRepository,
            $litecoinRepository;

    public function construct() {
        $this->bitcoinRepository = new BitcoinRepository;
        $this->litecoinRepository = new LitecoinRepository;
    }

    public function run() {
        RatesProducer::listen(function($currency, $value) {
            $repository = $this->getRepositoryForCurrency($currency);

            $this->processNewRate($repository, $value);

            $repository->timestampExists();
        });
    }



    private function getRepositoryForCurrency(string $currency) {
        switch($currency) {
            case 'bitcoin': {
                return $this->bitcoinRepository;
            }
            case 'litecoin': {
                return $this->litecoinRepository;
            }
        }
    }

    private function processNewRate(CurrencyRepositoryContract $repository, $value) {
        $timestamp = now();

        $singleRate = new SingleRate($timestamp, $value);
        $repository->add($timestamp, $singleRate);


    }
}
