<?php
namespace Evilamany\Rates\Contracts;

use Evilamany\Rates\Contracts\RateContract;

interface RateRepositoryContract
{
    public function setCurrency(string $currency);

    public function updateOrCreate(RateContract $rate);

    public function exists(int $timestamp);

    public function find(int $timestamp);
}
