<?php

namespace VinaiKopp\CurrencyInfo\Internal;

use VinaiKopp\CurrencyInfo\Build\CurrencyInfoKeys;
use VinaiKopp\CurrencyInfo\CurrencyInfo;
use VinaiKopp\CurrencyInfo\Exception\UnknownCurrencyException;

/**
 * @covers \VinaiKopp\CurrencyInfo\Internal\GenericCurrencyInfoAccess
 */
class GenericCurrencyInfoAccessTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @return array[]
     */
    public function infoTypeCodeDataProvider()
    {
        return [
            [CurrencyInfo::SYMBOL, 'string'],
            [CurrencyInfo::SYMBOL_NATIVE, 'string'],
            [CurrencyInfo::CODE, 'string'],
            [CurrencyInfo::FRACTION_DIGITS, 'int'],
            [CurrencyInfo::ROUNDING, 'float'],
        ];
    }

    /**
     * @param string $infoType
     * @param string $expectedType
     * @dataProvider infoTypeCodeDataProvider
     */
    public function testReturnsTheInfoTypeMapForGivenCurrency($infoType, $expectedType)
    {
        $map = GenericCurrencyInfoAccess::getCurrencyInfoSubMap($infoType);
        $this->assertInternalType('array', $map);
        $this->assertNotEmpty($map);
        $this->assertContainsOnly($expectedType, $map);
    }

    /**
     * @param string $infoType
     * @param string $expectedType
     * @dataProvider infoTypeCodeDataProvider
     */
    public function testReturnsTheValueForGivenInfoTypeAndCurrency($infoType, $expectedType)
    {
        $value = GenericCurrencyInfoAccess::getCurrencyInfoItemForCurrency($infoType, 'EUR');
        $this->assertInternalType($expectedType, $value);
    }

    public function testThrowsExceptionIfCurrencyIsNotKnown()
    {
        $this->expectException(UnknownCurrencyException::class);
        $this->expectExceptionMessage('The currency "UNKNOWN" is not known');
        GenericCurrencyInfoAccess::getCurrencyInfoItemForCurrency(CurrencyInfo::SYMBOL, 'UNKNOWN');
    }

    public function testReturnsTheMapForAGivenCurrency()
    {
        $euroInfo = CurrencyInfo::getMapForCurrency('EUR');
        $currencyInfoKeys = new CurrencyInfoKeys();
        array_map(function ($infoKey) use ($euroInfo) {
            $this->assertArrayHasKey($infoKey, $euroInfo);
        }, $currencyInfoKeys->get());
    }
}
