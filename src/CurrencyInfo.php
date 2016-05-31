<?php

namespace VinaiKopp\CurrencyInfo;

use VinaiKopp\CurrencyInfo\StaticAccess\CurrencyInfo as StaticCurrencyInfo;

class CurrencyInfo implements CurrencyInfoInterface
{
    public $staticCurrencyInfoClass = StaticCurrencyInfo::class;
    
    /**
     * @return array[]
     */
    public function getMap()
    {
        return forward_static_call([$this->staticCurrencyInfoClass, __FUNCTION__]);
    }

    /**
     * @param string $currencyCode
     * @return array
     */
    public function getMapForCurrency($currencyCode)
    {
        return forward_static_call([$this->staticCurrencyInfoClass, __FUNCTION__], $currencyCode);
    }

    /**
     * @return string[]
     */
    public function getSymbolMap()
    {
        return forward_static_call([$this->staticCurrencyInfoClass, __FUNCTION__]);
    }

    /**
     * @param string $currencyCode
     * @return string
     */
    public function getSymbolForCurrency($currencyCode)
    {
        return forward_static_call([$this->staticCurrencyInfoClass, __FUNCTION__], $currencyCode);
    }

    /**
     * @return string[]
     */
    public function getNativeSymbolMap()
    {
        return forward_static_call([$this->staticCurrencyInfoClass, __FUNCTION__]);
    }

    /**
     * @param string $currencyCode
     * @return string
     */
    public function getNativeSymbolForCurrency($currencyCode)
    {
        return forward_static_call([$this->staticCurrencyInfoClass, __FUNCTION__], $currencyCode);
    }

    /**
     * @return int[]
     */
    public function getFractionDigitsMap()
    {
        return forward_static_call([$this->staticCurrencyInfoClass, __FUNCTION__]);
    }

    /**
     * @param string $currencyCode
     * @return int
     */
    public function getFractionDigitsForCurrency($currencyCode)
    {
        return forward_static_call([$this->staticCurrencyInfoClass, __FUNCTION__], $currencyCode);
    }

    /**
     * @return float[]
     */
    public function getRoundingMap()
    {
        return forward_static_call([$this->staticCurrencyInfoClass, __FUNCTION__]);
    }

    /**
     * @param string $currencyCode
     * @return float
     */
    public function getRoundingForCurrency($currencyCode)
    {
        return forward_static_call([$this->staticCurrencyInfoClass, __FUNCTION__], $currencyCode);
    }
}
