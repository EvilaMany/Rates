<?php
namespace Evilamany\Rates\RatesPacker;

use Evilamany\Rates\Contracts\StorageContract;
use Evilamany\Rates\Models\RawRate\RawRate;

class SinglePacker {
	protected $storage;

	public function __construct(StorageContract $storage) {
		$this->storage = $storage;
	}

	public function pack(RawRate $rate) {
		if($this->storage->exists($timestamp)) {
            $rate = $this->singleRateRepository->find($timestamp);
        } else {
            $rate = new SingleRate($timestamp, $value);
        }

        $this->singleRateRepository->updateOrCreate($rate);

        EventBus::publish('single.updatedOrCreated', json_encode([
            'rate' => $rate->toArray()
        ]));
	}
}