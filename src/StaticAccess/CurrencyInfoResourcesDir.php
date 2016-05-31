<?php

namespace VinaiKopp\CurrencyInfo\StaticAccess;

class CurrencyInfoResourcesDir
{
    public static function get()
    {
        return realpath(__DIR__ . '/../../resources');
    }
}
