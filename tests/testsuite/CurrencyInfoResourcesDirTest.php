<?php

namespace VinaiKopp\CurrencyInfo;

/**
 * @covers \VinaiKopp\CurrencyInfo\CurrencyInfoResourcesDir
 */
class CurrencyInfoResourcesDirTest extends \PHPUnit_Framework_TestCase
{
    public function testReturnsTheResourcesDirectoryPath()
    {
        $this->assertSame(realpath(__DIR__ . '/../../resources'), CurrencyInfoResourcesDir::get());
    }
}
