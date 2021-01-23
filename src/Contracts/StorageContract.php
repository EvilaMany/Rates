<?php
namespace Evilamany\Rates\Contracts;

use Evilamany\Rates\Contracts\RateContract;
use Evilamany\Rates\Models\Interval;
use Evilamany\Rates\Models\SingleRate\SingleRate;
use Evilamany\Rates\Models\CandleRate\CandleRate;

interface StorageContract {
    public function setSingle($currency, SingleRate $rate): bool;
    public function setCandle($currency, CandleRate $rate): bool;

    public function getSingles($currency, int $timestampFrom, int $timestampTo): ?array;
    public function getCandles($currency, Interval $interval, int $timestampFrom, int $timestampTo): ?array;
}
