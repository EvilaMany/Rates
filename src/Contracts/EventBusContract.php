<?php
namespace Evilamany\Rates\Contracts;

interface EventBusContract {
    /**
     * @param string $event
     * @param $callback
     * @return mixed
     */
    public static function subscribe(string $event, $callback);

    /**
     * @param string $event
     * @param string $value
     * @return mixed
     */
    public static function publish(string $event, string $value);
}
