<?php
namespace Evilamany\Rates;

use Evilamany\Rates\Contracts\RateProviderContract;
use Evilamany\Rates\EventBus;

class CoincapRateProvider implements RateProviderContract {

    protected const CURRENCIES = [
        'bitcoin',
        'litecoin',
        'dogecoin',
        'neo',
        'etherium',
        'ripple',
        'tron'
    ];

    public function __construct() {

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
            self::publishEvent('request');
        });

        $client->on("handshake", function () {
            self::publishEvent('handshake');
        });

        $client->on("connect", function () use ($logger, $client) {
            self::publishEvent('connect');
        });

        $client->on("message", function ($message) use ($client) {
            self::publishEvent('rate', $message);
        });

        $client->open();

        $loop->run();

        $this->handle();
    }

    private static function publishEvent($action, $info = null) {
        $message = [
            'action' => $action
        ];

        if($info) $message['info'] = $info;

        EventBus::publish();
    }
}
