<?php
namespace Evilamany\Rates\Contracts;

interface RateRepositoryContract
{
    public function push(string $currency);

    public function timestampExists(int $timestamp);

    public function getByTimestamp(int $timestamp);
}
