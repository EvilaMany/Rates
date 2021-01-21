<?php
namespace Evilamany\Rates\Models;

use Evilamany\Rates\Contracts\RateContract;

class CandleRate implements RateContract
{
    public
        $start = null,
        $end = null,
        $max = null,
        $min = null;

    private
        /**
         * First second of inverval
         */
        $timestamp = null,
        /**
         * Interval in minutes
         */
        $interval = null;

    public function __construct($timestamp, int $interval, array $values) {
        $this->interval = $interval;

        $this->timestamp = $timestamp - ($timestamp % ($interval * 60));
        $this->start = $values['start'] ?? null;
        $this->end = $values['end'] ?? null;
        $this->max = $values['max'] ?? null;
        $this->min = $values['min'] ?? null;
    }


    public function getTimestamp() {
        return $this->timestamp;
    }

    public function save() {

    }

    public function __toString() {
        return '';
    }
}
