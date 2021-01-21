<?php
namespace Evilamany\Rates\Contracts;

interface RateContract
{
    public function toArray();

    public function getTimestamp();
}
