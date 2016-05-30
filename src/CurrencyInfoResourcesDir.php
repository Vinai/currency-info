<?php

namespace VinaiKopp\CurrencyInfo;

class CurrencyInfoResourcesDir
{
    public static function get()
    {
        return realpath(__DIR__ . '/../resources');
    }
}
