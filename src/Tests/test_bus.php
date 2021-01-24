<?php
require('vendor/autoload.php');

use Evilamany\Rates\EventBuses\RedisEventBus;
use Evilamany\Rates\RateProviders\CoincapRateProvider;
use Evilamany\Rates\Gateways\RedisGateway;

//$redis = new Redis();

//$redis->connect('127.0.0.1', 6379);

$gateway = new RedisGateway([
    'host' => '127.0.0.1',
    'post' => '6379',
    'password' => null,
    'database' => 'rates'
]);

$bus = new RedisEventBus($gateway);


if($argv[1] == 'sub') {
    $bus->subscribe('time', function (string $message) {
        print_r($message);
    });
}


if($argv[1] == 'pub') {
    $bus->publish('time', time());
}

/*
$gateway->publish('name', 'VALUE1');


$gateway->subscribe('name', function($redis, $channel, $message) {
	print_r($redis);
}); */
