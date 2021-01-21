<?php
namespace Evilamany\Rates\Facades;

use Evilamany\Rates\Contracts\FacadeContract;

class Facade implements FacadeContract{
    protected static $instance = null;

    protected function __construct() {}

    public function __callStatic($name, $arguments) {
        if(self::$instance == null) {
            self::$instance = new self::$className;
        }


        return call_user_func(self::$instance->{$name}, $arguments);
    }


    public function makeInstance() {
        return new Self;
    }
}
