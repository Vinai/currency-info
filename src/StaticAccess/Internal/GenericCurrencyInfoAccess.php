<?php

namespace VinaiKopp\CurrencyInfo\StaticAccess\Internal;

use VinaiKopp\CurrencyInfo\StaticAccess\CurrencyInfoResourcesDir;
use VinaiKopp\CurrencyInfo\Exception\UnknownCurrencyException;

class GenericCurrencyInfoAccess
{
    private static $memoizedMapData = [];

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
     * @return string[]|int[]|float[]
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
        $mapFileName = self::getMapFileName($infoKey);
        return self::requireFile($mapFileName);
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
     * @param array[]|string[]|int[]|float[] $map
     * @param string $currencyCode
     */
    private static function validateCurrencyIsKnown(array $map, $currencyCode)
    {
        if (!isset($map[$currencyCode])) {
            throw new UnknownCurrencyException(sprintf('The currency "%s" is not known', $currencyCode));
        }
    }

    /**
     * @param string $mapFileName
     * @return array[]|string[]|int[]|float[]
     */
    private static function requireFile($mapFileName)
    {
        if (!isset(self::$memoizedMapData[$mapFileName])) {
            self::$memoizedMapData[$mapFileName] = require $mapFileName;
        }
        return self::$memoizedMapData[$mapFileName];
    }
}
