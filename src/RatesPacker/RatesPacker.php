<?php
namespace Evilamany\Rates\RatesPacker;

use Evilamany\Rates\Contracts\EventBusContract;
use Evilamany\Rates\Models\RawRate\RawRate;

class RatesPacker {
	private $eventBus;

	public function __construct(EventBusContract $eventBus) {
		$this->eventBus = $eventBus;
	}



	public function run() {
		$this->eveneBus->onRateRelised(function(RawRate $rate) {
			$this->packRate($rate);
		});
	}

	private function packRate(RawRate $rate) {

	}

	private function cleanOlder() {

	}
}
