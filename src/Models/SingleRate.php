<?php
namespace Evilamany\Rates\Models;

use Evilamany\Rates\Contracts\RateContract;
use Evilamany\Rates\Repositories\SignleRatesRepository;

class SingleRate implements RateContract {
    public
        $value = null;

    private
        $timestamp = null;


    /**
     * SingleRate constructor.
     * @param $timestamp
     * @param integer $value
     */
    public function __construct($timestamp, integer $value) {
        $this->timestamp = $timestamp;
        $this->value = $value;
    }

    /**
     * @return |null
     */
    public function getTimestamp() {
        return $this->timestamp;
    }

    public function save() {

    }

    public function __toString() {
        return '';
    }
}
