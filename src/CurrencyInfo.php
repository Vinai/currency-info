<?php

namespace VinaiKopp\CurrencyInfo;

use VinaiKopp\CurrencyInfo\Internal\GenericCurrencyInfoAccess;

class CurrencyInfo
{
    const SYMBOL = 'symbol';
    const SYMBOL_NATIVE = 'symbol_native';
    const FRACTION_DIGITS = 'decimal_digits';
    const ROUNDING = 'rounding';
    const CODE = 'code';

    /**
     * @return array[]
     */
    public static function getMap()
    {
        return GenericCurrencyInfoAccess::getFullCurrencyInfo();
    }

    /**
     * @param $currencyCode
     * @return array
     */
    public static function getMapForCurrency($currencyCode)
    {
        return GenericCurrencyInfoAccess::getMapForCurrency($currencyCode);
    }

    /**
     * @return string[]
     */
    public static function getSymbolMap()
    {
        return GenericCurrencyInfoAccess::getCurrencyInfoSubMap(self::SYMBOL);
    }

    /**
     * @param string $currencyCode
     * @return string
     */
    public static function getSymbolForCurrency($currencyCode)
    {
        return GenericCurrencyInfoAccess::getCurrencyInfoItemForCurrency(self::SYMBOL, $currencyCode);
    }

    /**
     * @return string[]
     */
    public static function getNativeSymbolMap()
    {
        return GenericCurrencyInfoAccess::getCurrencyInfoSubMap(self::SYMBOL_NATIVE);
    }

    /**
     * @param string $currencyCode
     * @return string
     */
    public static function getNativeSymbolForCurrency($currencyCode)
    {
        return GenericCurrencyInfoAccess::getCurrencyInfoItemForCurrency(self::SYMBOL_NATIVE, $currencyCode);
    }

    /**
     * @return int[]
     */
    public static function getFractionDigitsMap()
    {
        return GenericCurrencyInfoAccess::getCurrencyInfoSubMap(self::FRACTION_DIGITS);
    }

    /**
     * @param string $currencyCode
     * @return int
     */
    public static function getFractionDigitsForCurrency($currencyCode)
    {
        return GenericCurrencyInfoAccess::getCurrencyInfoItemForCurrency(self::FRACTION_DIGITS, $currencyCode);
    }

    /**
     * @return float[]
     */
    public static function getRoundingMap()
    {
        return GenericCurrencyInfoAccess::getCurrencyInfoSubMap(self::ROUNDING);
    }

    /**
     * @param string $currencyCode
     * @return float
     */
    public static function getRoundingForCurrency($currencyCode)
    {
        return GenericCurrencyInfoAccess::getCurrencyInfoItemForCurrency(self::ROUNDING, $currencyCode);
    }
}
