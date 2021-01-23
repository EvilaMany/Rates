<?php
namespace Evilamany\Rates\Models\RawRate;

use Evilamany\Rates\Contracts\RateContract;

class RawRate implements RateContract {
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
    public function __construct($timestamp, $currency, int $value) {
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

    /**
     * @return string
     */
    public function getCurrency(): string {
        return $this->currency;
    }

    /**
     * @return array
     */
    public function toArray(): array {
        return [
            'value' => $this->value,
            'timestamp' => $this->timestamp
        ];
    }
}
