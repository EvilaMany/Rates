<?php
namespace Evilamany\Rates\Models\SingleRate;

use Evilamany\Rates\Contracts\RateContract;

class SingleRate extends Rate implements RateContract {
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

    public function toArray() {
        return [
            'value' => $this->value,
            'timestamp' => $this->timestamp
        ];
    }
}
