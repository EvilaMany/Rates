<?php
namespace Evilamany\Rates\Contracts;

use Evilamany\Rates\Models\RawRate\RawRate;
use Evilamany\Rates\Models\SingleRate\SingleRate;
use Evilamany\Rates\Models\CandleRate\CandleRate;

interface EventBusContract {
    public function subscribe(string $event, Callable $callback);

    public function publish(string $event, string $value): bool;

    public function publishRateRelised(RawRate $rate): bool;

    public function publishSingleUpdated(SingleRate $rate): bool;

    public function publishCandleUpdated(CandleRate $rate): bool;



    public function onRateRelised(Callable $callback);

    public function onSingleUpdated(Callable $callback);

    public function onCandleUpdated(Callable $callback);
}
