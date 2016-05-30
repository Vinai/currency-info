<?php

namespace VinaiKopp\CurrencyInfo\Build;

use VinaiKopp\CurrencyInfo\CurrencyInfo;

class CurrencyInfoKeys
{
    private static $keys = [
        CurrencyInfo::SYMBOL,
        CurrencyInfo::SYMBOL_NATIVE,
        CurrencyInfo::FRACTION_DIGITS,
        CurrencyInfo::ROUNDING,
        CurrencyInfo::CODE,
    ];

    /**
     * @return string[]
     */
    public static function getStatic()
    {
        return self::$keys;
    }

    /**
     * @return string[]
     */
    public function get()
    {
        return self::$keys;
    }
}
