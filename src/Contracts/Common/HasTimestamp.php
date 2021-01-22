<?php
namespace Evilamany\Rates\Contracts\Common;

interface HasTimestamp
{
    public function getTimestamp(): ?int;
}
