<?php
namespace Evilamany\Rates\Contracts;

interface RateContract
{
    public function save();

    public function __toString();

    public function getTimestamp();
}
