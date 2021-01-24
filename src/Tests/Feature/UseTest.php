<?php
use PHPUnit\Framework\TestCase;
use Evilamany\Rates\RatesBroker;
use Evilamany\Rates\CoincapRateProvider;

class UseTest extends TestCase
{
    public function useTest() {
        $ratesStorage = new RedisStorage($config = []);

        $eventBus = new EventBus($config = []);

        $provider = new CoincapRateProvider($eventBus)
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
        $packer->setKinds(['single', 'candle']);
        $packer->run();

        #
        $packer->cleanOlder(86400);

        #
        $ratesStorage->getSingles($currency, $timeFrom, $timeTo);
        $ratesStorage->getCandles1min($currency, $timeFrom, $timeTo);

        $eventBus->onCandleUpdate(function(CandleRate $candle){  });
        $eventBus->onSingleUpdate(function(SingleRate $rate){ });

        #
        $eventBus->onRateRelise(function(RawRate $rate) {
            //...update predictions
        });
    }
}
