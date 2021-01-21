<?php
namespace Evilamany\Rates\Contracts;

interface FacadeContract
{
    function __callStatic($name, $arguments);

    function makeInstance();
}
