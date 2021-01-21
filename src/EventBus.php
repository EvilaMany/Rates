<?php
namespace Evilamany\Rates;

use Evilamany\Rates\Contracts\EventBusContract;
use Evilamamy\Rates\Facades\RedisFacade;

class EventBus implements EventBusContract {
    private function __construct() {}

    public static function subscribe(string $event, $callback) {
        RedisFacade::subscribe($event, function($type, $channel, $message) use ($callback) {
            if($type == 'message') {
                $callback($message, $type);
            }
        });
    }

    public static function publish(string $event, string $value) {
        RedisFacade::publish($event, $value);
    }
}
