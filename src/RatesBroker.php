<?php
namespace Evilamany\Rates;

use Evilamany\Rates\Services\CandleRateService;
use Evilamany\Rates\Services\SingleRateService;
use Evilamany\Rates\Facades\RedisFacade;
use Evilamany\Rates\CoincapRateProvider as RateProvider;

class RatesBroker
{
    private $candleRateService,
            $singleRateService;

    public function construct($config) {

        $this->candleRateService = new CandleRateService;
        $this->singleRateService = new SingleRateService;

        RedisFacade::setConnection($config['redis']);
    }

    public function run() {
        RateProvider::listen(function($currency, $value) {
            $now = now()->timestamp;

            $this->singleRateService->processValue($value, $now, $currency);
            $this->candleRateService->processValue($value, $now, $currency);
        });
    }
}
