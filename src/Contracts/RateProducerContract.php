<?php
namespace Evilamany\Rates\Contracts;

interface RateProducerContract
{
    public static function subscribe($messageCallback);
}
