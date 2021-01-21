<?php
namespace Evilamany\Rates\Repositories;

use Evilamany\Rates\Models\CandleRate;

use Evilamany\Rates\Models\Candle1min0Rate;
use Evilamany\Rates\Models\Candle5minRate;
use Evilamany\Rates\Models\Candle10minRate;
use Evilamany\Rates\Models\Candle15minRate;
use Evilamany\Rates\Models\Candle30minRate;
use Evilamany\Rates\Models\Candle60minRate;

class CandleRatesRepository
{
    public function update(CandleRate $rate) {
        if($rate instanceof Candle1minRate) {

        }
        //...
    }
}
