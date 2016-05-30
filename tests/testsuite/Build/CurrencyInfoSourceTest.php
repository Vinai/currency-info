<?php

namespace VinaiKopp\CurrencyInfo\Build;

use VinaiKopp\CurrencyInfo\CurrencyInfo;

/**
 * @covers \VinaiKopp\CurrencyInfo\Build\CurrencyInfoSource
 */
class CurrencyInfoSourceTest extends \PHPUnit_Framework_TestCase
{
    public function testReturnsInstanceWithGivenJson()
    {
        $testSource = [
            'EUR' => [
                CurrencyInfo::SYMBOL          => 'EUR',
                CurrencyInfo::SYMBOL_NATIVE   => '€',
                CurrencyInfo::FRACTION_DIGITS => 2,
                CurrencyInfo::ROUNDING        => 0,
                CurrencyInfo::CODE            => 'EUR',
            ],
        ];
        $currencyInfoSource = new CurrencyInfoSource($testSource);
        $this->assertSame($testSource, $currencyInfoSource->get());
    }

    public function testThrowsExceptionIfInputIsNotString()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Input has to be a JSON encoded currency info object');
        CurrencyInfoSource::fromJson('foo');
    }

    public function testReturnsCurrencyInfoSourceInstanceFromGivenJsonString()
    {
        $testSource = ['foo' => ['bar' => 'buz']];
        $currencyInfoSource = CurrencyInfoSource::fromJson(json_encode($testSource));
        $this->assertInstanceOf(CurrencyInfoSource::class, $currencyInfoSource);
        $this->assertSame($testSource, $currencyInfoSource->get());
    }

    public function testReturnsCurrencyInfoInstanceBasedOnFileName()
    {
        $testSource = ['foo' => ['bar' => 'buz']];
        $fileName = tempnam(sys_get_temp_dir(), 'test-');
        register_shutdown_function(function () use ($fileName) {
            @unlink($fileName);
        });
        file_put_contents($fileName, json_encode($testSource));

        $currencyInfoSource = CurrencyInfoSource::fromFile($fileName);
        $this->assertInstanceOf(CurrencyInfoSource::class, $currencyInfoSource);
        $this->assertSame($testSource, $currencyInfoSource->get());
    }
}
