<?php

namespace VinaiKopp\CurrencyInfo\Build;

use VinaiKopp\CurrencyInfo\CurrencyInfo;

/**
 * @covers \VinaiKopp\CurrencyInfo\Build\CurrencyInfoToSeparateMaps
 */
class CurrencyInfoToSeparateMapsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider expectedInfoTypeArrayDataProvider
     */
    public function testReturnsEachInfoTypeAsAnArray($infoType, array $expected)
    {
        $testSource = [
            'ABC' => [
                CurrencyInfo::SYMBOL          => 'AB',
                CurrencyInfo::SYMBOL_NATIVE   => 'ab',
                CurrencyInfo::FRACTION_DIGITS => 2,
                CurrencyInfo::ROUNDING        => 0,
                CurrencyInfo::CODE            => 'ABC',
            ],
            'DEF' => [
                CurrencyInfo::SYMBOL          => 'DE',
                CurrencyInfo::SYMBOL_NATIVE   => 'de',
                CurrencyInfo::FRACTION_DIGITS => 3,
                CurrencyInfo::ROUNDING        => 1,
                CurrencyInfo::CODE            => 'DEF',
            ],
        ];
        $this->assertSame($expected, CurrencyInfoToSeparateMaps::build($testSource, $infoType));
    }

    public function expectedInfoTypeArrayDataProvider()
    {
        return [
            CurrencyInfo::SYMBOL          => [CurrencyInfo::SYMBOL, ['ABC' => 'AB', 'DEF' => 'DE']],
            CurrencyInfo::SYMBOL_NATIVE   => [CurrencyInfo::SYMBOL_NATIVE, ['ABC' => 'ab', 'DEF' => 'de']],
            CurrencyInfo::FRACTION_DIGITS => [CurrencyInfo::FRACTION_DIGITS, ['ABC' => 2, 'DEF' => 3]],
            CurrencyInfo::ROUNDING        => [CurrencyInfo::ROUNDING, ['ABC' => 0, 'DEF' => 1]],
            CurrencyInfo::CODE            => [CurrencyInfo::CODE, ['ABC' => 'ABC', 'DEF' => 'DEF']],
        ];
    }
}
