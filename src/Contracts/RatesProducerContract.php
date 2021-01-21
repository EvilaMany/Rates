<?php
namespace Evilamany\Rates\Contracts;

interface RatesProducerContract
{
    public static function subscribe($messageCallback);
}
