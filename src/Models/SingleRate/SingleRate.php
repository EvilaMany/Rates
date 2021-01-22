<?php
namespace Evilamany\Rates\Models\SingleRate;

use Evilamany\Rates\Contracts\RateContract;

class SingleRate extends Rate implements RateContract {
    public
        $value = null;

    private
        $timestamp = null,

        $currency = null;


    /**
     * SingleRate constructor.
     * @param $timestamp
     * @param integer $value
     */
    public function __construct($timestamp, $currency, integer $value) {
        $this->timestamp = $timestamp;
        $this->value = $value;
        $this->currency = $currency;
    }

    /**
     * @return |null
     */
    public function getTimestamp(): ?int {
        return $this->timestamp;
    }


    public function getCurrency(): string {
        return $this->currency;
    }

    public function toArray(): array {
        return [
            'value' => $this->value,
            'timestamp' => $this->timestamp
        ];
    }
}
