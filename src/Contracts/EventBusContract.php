<?php
namespace Evilamany\Rates\Contracts;

interface EventBusContract {
    public static function subscribe(string $event, $callback);

    public static function publish(string $event, string $value);
}
