<?php

namespace VinaiKopp\CurrencyInfo;

use VinaiKopp\CurrencyInfo\Build\CurrencyInfoKeys;
use VinaiKopp\CurrencyInfo\Exception\UnknownCurrencyException;

/**
 * @covers \VinaiKopp\CurrencyInfo\CurrencyInfo
 */
class CurrencyInfoTest extends \PHPUnit_Framework_TestCase
{
    public function testReturnsTheCompleteCurrencyInfoArray()
    {
        $currencyInfo = CurrencyInfo::getMap();
        $this->assertInternalType('array', $currencyInfo);
        $this->assertNotEmpty($currencyInfo);
        $this->assertContainsOnly('array', $currencyInfo);
    }

    public function testReturnsAllRecordsForGivenCurrency()
    {
        $euroInfo = CurrencyInfo::getMapForCurrency('EUR');
        array_map(function ($infoKey) use ($euroInfo) {
            $this->assertArrayHasKey($infoKey, $euroInfo);
        }, CurrencyInfoKeys::getStatic());
    }

    public function testThrowsExceptionIfMapForCurrencyIsNotKnown()
    {
        $this->expectException(UnknownCurrencyException::class);
        $this->expectExceptionMessage('The currency "XXX" is not known');
        CurrencyInfo::getMapForCurrency('XXX');
    }

    public function testReturnsTheSymbolMap()
    {
        $map = CurrencyInfo::getSymbolMap();
        $this->assertInternalType('array', $map);
        $this->assertNotEmpty($map);
        $this->assertContainsOnly('string', $map);
        $this->assertArrayHasKey('IDR', $map);
        $this->assertSame('IDR', $map['IDR']);
    }

    public function testReturnsTheSymbolForGivenCurrency()
    {
        $this->assertSame('€', CurrencyInfo::getSymbolForCurrency('EUR'));
        $this->assertSame('$', CurrencyInfo::getSymbolForCurrency('USD'));
        $this->assertSame('IDR', CurrencyInfo::getSymbolForCurrency('IDR'));
    }

    public function testReturnsTheNativeSymbolMap()
    {
        $map = CurrencyInfo::getNativeSymbolMap();
        $this->assertInternalType('array', $map);
        $this->assertNotEmpty($map);
        $this->assertContainsOnly('string', $map);
        $this->assertArrayHasKey('IDR', $map);
        $this->assertSame('Rp', $map['IDR']);
    }

    public function testReturnsTheNativeSymbolForGivenCurrency()
    {
        $this->assertSame('€', CurrencyInfo::getNativeSymbolForCurrency('EUR'));
        $this->assertSame('$', CurrencyInfo::getNativeSymbolForCurrency('USD'));
        $this->assertSame('Rp', CurrencyInfo::getNativeSymbolForCurrency('IDR'));
    }

    public function testReturnsTheFractionDigitsMap()
    {
        $map = CurrencyInfo::getFractionDigitsMap();
        $this->assertInternalType('array', $map);
        $this->assertNotEmpty($map);
        $this->assertContainsOnly('int', $map);
        $this->assertArrayHasKey('IDR', $map);
        $this->assertSame(0, $map['IDR']);
    }

    public function testReturnsTheFractionDigitsForGivenCurrency()
    {
        $this->assertSame(2, CurrencyInfo::getFractionDigitsForCurrency('EUR'));
        $this->assertSame(0, CurrencyInfo::getFractionDigitsForCurrency('IDR'));
        $this->assertSame(3, CurrencyInfo::getFractionDigitsForCurrency('JOD'));
    }

    public function testReturnsTheRoundingMap()
    {
        $map = CurrencyInfo::getRoundingMap();
        $this->assertInternalType('array', $map);
        $this->assertNotEmpty($map);
        $this->assertContainsOnly('float', $map);
        $this->assertSame(0.0, $map['IDR']);
    }

    public function testReturnsTheRoundingForGivenCurrency()
    {
        $this->assertSame(0.0, CurrencyInfo::getRoundingForCurrency('EUR'));
        $this->assertGreaterThan(0.01, CurrencyInfo::getRoundingForCurrency('CHF'));
    }
}
