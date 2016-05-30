<?php

namespace VinaiKopp\CurrencyInfo\Build;

use VinaiKopp\CurrencyInfo\CurrencyInfo;

/**
 * @covers \VinaiKopp\CurrencyInfo\Build\CurrencyInfoKeys
 */
class CurrencyInfoKeysTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @param string $expectedKey
     * @dataProvider currencyInfoKeyDataProvider
     */
    public function testProvidesKeysInCurrencyInfoArray($expectedKey)
    {
        $currencyInfoKeys = new CurrencyInfoKeys();
        $this->assertContains($expectedKey, $currencyInfoKeys->get());
    }

    /**
     * @param string $expectedKey
     * @dataProvider currencyInfoKeyDataProvider
     */
    public function testProvidesStaticGetterMethod($expectedKey)
    {
        $this->assertContains($expectedKey, CurrencyInfoKeys::getStatic());
    }

    /**
     * @return array[]
     */
    public function currencyInfoKeyDataProvider()
    {
        return [
            [CurrencyInfo::SYMBOL],
            [CurrencyInfo::SYMBOL_NATIVE],
            [CurrencyInfo::FRACTION_DIGITS],
            [CurrencyInfo::ROUNDING],
            [CurrencyInfo::CODE],
        ];
    }
}
