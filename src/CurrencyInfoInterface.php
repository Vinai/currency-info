<?php
namespace VinaiKopp\CurrencyInfo;

interface CurrencyInfoInterface
{
    /**
     * @return array[]
     */
    public function getMap();

    /**
     * @param string $currencyCode
     * @return array
     */
    public function getMapForCurrency($currencyCode);

    /**
     * @return string[]
     */
    public function getSymbolMap();

    /**
     * @param string $currencyCode
     * @return string
     */
    public function getSymbolForCurrency($currencyCode);

    /**
     * @return string[]
     */
    public function getNativeSymbolMap();

    /**
     * @param string $currencyCode
     * @return string
     */
    public function getNativeSymbolForCurrency($currencyCode);

    /**
     * @return int[]
     */
    public function getFractionDigitsMap();

    /**
     * @param string $currencyCode
     * @return int
     */
    public function getFractionDigitsForCurrency($currencyCode);

    /**
     * @return float[]
     */
    public function getRoundingMap();

    /**
     * @param string $currencyCode
     * @return float
     */
    public function getRoundingForCurrency($currencyCode);
}
