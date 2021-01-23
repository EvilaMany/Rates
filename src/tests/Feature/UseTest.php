<?php
use PHPUnit\Framework\TestCase;
use Evilamany\Rates\RatesBroker;
use Evilamany\Rates\CoincapRateProvider;

class UseTest extends TestCase
{
    public function useTest() {
        $ratesStorage = new RedisStorage($config = []);

        $eventBus = new EventBus($config = []);

        $provider = CoincapRateProvider($eventBus)
            ->setCurrencies([
                'bitcoin',
                'litecoin'
            ])
            ->setMutator(function(RawRate $rate) {
                return $rate;
            });
        $provider->run();

        #
        $packer = new RatesPacker($eventBus, $ratesStorage);

        $packer->run();

        #
        $packer->cleanOlder(86400);

        #
        $ratesStorage->getSingles($currency, $timeFrom, $timeTo);

        $ratesStorage->getCandles1min($currency, $timeFrom, $timeTo);
    }
}
