<?php
namespace Evilamany\Rates\Repositories;

use Evilamany\Rates\Models\SingleRate;
use Evilamany\Rates\Contracts\RateRepositoryContract;

class LitecoinRepository implements RateRepositoryContract
{
    public function update(int $timestamp, SingleRate $rate) {
        //$this->database->update();
    }

    public function add() {

    }

    public function timestampExists(int $timestamp) {

    }

    public function getByTimestamp(int $timestamp) {

    }
}
