<?php
namespace Evilamany\Rates\Models\CandleRate;

use Evilamany\Rates\Contracts\RateContract;

class CandleRate implements RateContract
{
    public
        $start = null,
        $end = null,
        $max = null,
        $min = null,
        /**
         * minutes
         */
        $interval = null;

    // MINUTES
    const INTERVALS = [
        1,
        5,
        15,
        30,
        60
    ];

    private
        /**
         * First second of inverval
         */
        $timestamp = null,

        $currency = null;

    public function __construct($timestamp, $currency, array $values) {
        $this->timestamp = $timestamp;// - ($timestamp % ($interval * 60));
        $this->start = $values['start'] ?? null;
        $this->end = $values['end'] ?? null;
        $this->max = $values['max'] ?? null;
        $this->min = $values['min'] ?? null;
        $this->currency = $currency;
    }


    public function getTimestamp(): ?int {
        return $this->timestamp;
    }

    public function getCurrency(): string {
        return $this->currency;
    }

    public function toArray(): array {
        return [
            'min' => $this->min,
            'max' => $this->max,
            'start' => $this->start,
            'end' => $this->end,
            'interval' => $this->interval,
            'timestamp' => $this->timestamp
        ];
    }
}
