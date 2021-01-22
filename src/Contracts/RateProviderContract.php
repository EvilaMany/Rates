<?php
namespace Evilamany\Rates\Contracts;

interface RateProviderContract
{
    public static function run($messageCallback);
}
