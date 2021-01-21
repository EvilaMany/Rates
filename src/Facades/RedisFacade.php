<?php
namespace Evilamany\Rates\Facades;

use Evilamany\Rates\Gateways\Redis;

class RedisFacade extends Facade
{
    public function makeInstance() {
        return new Redis;
    }
}
