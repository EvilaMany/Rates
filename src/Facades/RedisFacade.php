<?php
namespace Evilamany\Rates\Facades;

use Evilamany\Rates\Gateways\RedisGateway;

class RedisFacade extends Facade
{
    public function makeInstance() {
        return new RedisGateway;
    }
}
