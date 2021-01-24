<?php
namespace Evilamany\Rates\RateProviders;

use Evilamany\Rates\Contracts\EventBusContract;
use Evilamany\Rates\Contracts\RateProviderContract;
use Evilamany\Rates\Models\RawRate\RawRate;
use Evilamany\Rates\Logger;

class CoincapRateProvider implements RateProviderContract {

    private $eventBus,
            $mutator;


    protected const CURRENCIES = [
        'bitcoin',
        'litecoin',
        'dogecoin',
        'neo',
        'etherium',
        'ripple',
        'tron'
    ];

    protected $selectedCurrencies = [];

    public function __construct(EventBusContract $eventBus) {
		$this->eventBus = $eventBus;
		$this->selectedCurrencies = self::CURRENCIES;
		
        Logger::clean();
    }

    /**
     * Set currencies which'll be requested from the remote server
     *
     * @param array $currencies
     */
    public function setCurrencies(array $currencies) {
        foreach($currencies as $key => $currency) {
            if(!in_array($currency, self::CURRENCIES)) {
                unset($currencies[$key]);
            }
        }

        $this->selectedCurrencies = $currencies;
    }

    public function getCurrencies() {
        return $this->selectedCurrencies;
    }

    /**
     * @param callable $mutator
     */
    public function setMutator(Callable $mutator) {
        $this->mutator = $mutator;
    }

    public function run() {
        $loop = \React\EventLoop\Factory::create();

        $logger = new \Zend\Log\Logger();
        $writer = new \Zend\Log\Writer\Stream("php://output");
        $logger->addWriter($writer);


        $params = http_build_query([
            'assets' => implode(',', self::CURRENCIES)
        ]);

        $client = new \Devristo\Phpws\Client\WebSocket("wss://ws.coincap.io/prices?" . $params, $loop, $logger);

        $client->on("request", function ($headers) use ($logger) {
            $this->publishEvent('request');
        });

        $client->on("handshake", function () {
            $this->publishEvent('handshake');
        });

        $client->on("connect", function () use ($logger, $client) {
            $this->publishEvent('connect');
        });

        $client->on("message", function ($message) use ($client) {
            $this->createRates($message->getData());
            $this->publishEvent('rate', $message->getData());
        });

        $client->open();

        $loop->run();
    }

    private function publishEvent($action, $info = null) {
        $action = 'coincap.' . $action;
		
		$this->eventBus->publish($action, $info);
    }

    private function createRates(string $message) {
		$now = time();

        $ratesArray = json_decode($message, 1);

        foreach($ratesArray as $currency => $value) {
            $rawRate = new RawRate(
                (integer) $now,
                $currency,
                (integer) $value
			);
			
			if(is_callable($this->mutator)) {
				$rate = $this->mutator($rawRate);
			}

			$this->eventBus->publishRateRelised($rawRate);
        }


    }
}
