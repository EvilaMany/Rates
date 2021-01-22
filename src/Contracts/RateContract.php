<?php
namespace Evilamany\Rates\Contracts;

use Evilamany\Rates\Contracts\Common\Arrayble;
use Evilamany\Rates\Contracts\Common\HasTimestamp;

interface RateContract
    extends Arrayble, HasTimestamp
{
    public function getCurrency(): string;

}
