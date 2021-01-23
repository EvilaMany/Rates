<?php
namespace Evilamany\Rates\Models;

class Interval {

    public const INTERVALS = [
        1,
        5,
        10,
        15,
        30,
        60
    ]; // minutes

    protected $interval = null;



    /**
     * Interval constructor.
     * @param int $interval { minutes }
     */
    public function __construct(int $interval) {
        if(!in_array(self::INTERVALS, $interval)) throw new Exception('Unsupported interval');

        $this->interval = $interval;
    }

    public function nextPoint($timestamp) {
        return $timestamp + ($this->interval * 60);
    }

    public function prevPoint($timestamp) {
        return $timestamp - ($this->interval * 60);
    }

    public function __toString() {
        return (string) $this->interval;
    }

    public function roundTimestamp($timestamp) {
        return $timestamp - ($timestamp % (interval * 60));
    }
}
