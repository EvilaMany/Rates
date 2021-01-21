<?php
namespace Evilamany\Rates\Services;

use Evilamany\Rates\Models\SingleRate\SingleRate;
use Evilamany\Rates\Models\Interval;
use Evilamany\Rates\Repositories\SingleRateRepository;
use Evilamany\Rates\EventBus;

class SingleRateService
{
    private $singleRateRepository;


    public function __construct() {
        $this->singleRateRepository = new SingleRateRepository;
    }

    public function processValue($value, $timestamp) {
        if($this->singleRateRepository->exists($timestamp)) {
            $rate = $this->singleRateRepository->find($timestamp);
        } else {
            $rate = new SingleRate($timestamp, $value);
        }

        $this->singleRateRepository->updateOrCreate($rate);

        EventBus::publish('single.updatedOrCreated', json_encode([
            'rate' => $rate->toArray()
        ]));
    }
}
