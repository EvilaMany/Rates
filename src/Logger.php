<?php
namespace Evilamany\Rates;

class Logger
{
    public static function clean()
    {
        file_put_contents('log.txt', '');
    }

    public static function write($text) {
        $f = fopen('log.txt', 'a');
        fwrite($f, $text . PHP_EOL);
        fclose($f);
    }
}
