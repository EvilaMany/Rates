<?php
namespace Evilamany\Rates\Storages;

use Evilamany\Rates\Contracts\StorageContract;
use Evilamany\Rates\Models\SingleRate\SingleRate;
use Evilamany\Rates\Models\CandleRate\CandleRate;
use Evilamany\Rates\Contracts\RateContract;
use Evilamany\Rates\Models\Interval;

class RedisStorage implements StorageContract
{

    public function setSingle($currency, RateContract $rate): bool {
        if(!$rate instanceOf SingleRate) throw new Exception('Unexpected rate type');
    }

    public function setCandle($currency, RateContract $rate): bool {
        if(!$rate instanceOf CandleRate) throw new Exception('Unexpected rate type');
    }

    public function getSingles($currency, int $timestampFrom, int $timestampTo): ?array {

    }

    public function getCandles($currency, Interval $interval, int $timestampFrom, int $timestampTo): ?array {

    }
}
