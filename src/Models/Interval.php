<?php
namespace Evilamany\Rates\Models;

class Interval {

    protected $interval = null;

    /**
     * Interval constructor.
     * @param int $interval { minutes }
     */
    public function __construct(int $interval) {
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
