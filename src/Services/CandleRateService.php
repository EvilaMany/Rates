<?php
namespace Evilamany\Rates\Services;

use Evilamany\Rates\Models\CandleRate\CandleRate;
use Evilamany\Rates\Models\Interval;
use Evilamany\Rates\Repositories\CandleRateRepository;
use Evilamany\Rates\EventBus;

class CandleRateService
{
    private $candleRateRepository;

    public function __construct() {
        $this->candleRateRepository = new CandleRateRepository;
    }

    public function processValue($value, $timestamp) {
        foreach(CandleRate::INTERVALS as $intervalMinutes) {
            $interval = new Interval($intervalMinutes);

            $this->candleRateRepository->setInterval($interval);

            $intervalledTimestamp = $interval->roundTimestamp($timestamp);

            if($this->candleRateRepository->exist($intervalledTimestamp)) {
                /**
                 * Если уже есть свеча на этом промежутке времени, обновляем ее значения
                 */
                $candle = $this->candleRateRepository->get($intervalledTimestamp);

                $candle->max = max($candle->max, $value);
                $candle->min = min($candle->min, $value);
                $candle->end = $value;
            } else {
                /**
                 * Если свечи нет, создаем новую. Начала помечаем как конец предыдущей
                 */
                $oldCandle = $this->candleRateRepository->get($interval->prev($intervalledTimestamp));

                $candle = new CandleRate($intervalledTimestamp, [
                    'start' => $oldCandle->end,
                    'end' => $value,
                    'max' => $value,
                    'min' => $value
                ]);
            }

            $this->candleRateRepository->updateOrCreate($candle);

            EventBus::publish('candles.updatedOrCreated', json_encode([
                'interval' => $intervalMinutes,
                'rate' => $candle
            ]));
        }
    }
}
