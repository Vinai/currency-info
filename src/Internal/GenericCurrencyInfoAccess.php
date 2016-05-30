<?php

namespace VinaiKopp\CurrencyInfo\Internal;

use VinaiKopp\CurrencyInfo\CurrencyInfoResourcesDir;
use VinaiKopp\CurrencyInfo\Exception\UnknownCurrencyException;

class GenericCurrencyInfoAccess
{
    /**
     * @param string $infoKey
     * @return string
     */
    private static function getMapFileName($infoKey)
    {
        return CurrencyInfoResourcesDir::get() . '/currencymap-' . $infoKey . '.php';
    }

    /**
     * @return array[]
     */
    public static function getFullCurrencyInfo()
    {
        return require CurrencyInfoResourcesDir::get() . '/currencymap.php';
    }

    /**
     * @param $currencyCode
     * @return array
     */
    public static function getMapForCurrency($currencyCode)
    {
        $currencyInfoMap = self::getFullCurrencyInfo();
        self::validateCurrencyIsKnown($currencyInfoMap, $currencyCode);
        return $currencyInfoMap[$currencyCode];
    }
    
    /**
     * @param string $infoKey
     * @return string[]|int[]|float[]
     */
    public static function getCurrencyInfoSubMap($infoKey)
    {
        return require self::getMapFileName($infoKey);
    }

    /**
     * @param string $infoKey
     * @param string $currencyCode
     * @return string|int|float
     */
    public static function getCurrencyInfoItemForCurrency($infoKey, $currencyCode)
    {
        $map = self::getCurrencyInfoSubMap($infoKey);
        self::validateCurrencyIsKnown($map, $currencyCode);
        return $map[$currencyCode];
    }

    /**
     * @param array $map
     * @param string $currencyCode
     */
    private static function validateCurrencyIsKnown(array $map, $currencyCode)
    {
        if (!isset($map[$currencyCode])) {
            throw new UnknownCurrencyException(sprintf('The currency "%s" is not known', $currencyCode));
        }
    }
}
