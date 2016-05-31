<?php

namespace VinaiKopp\CurrencyInfo\StaticAccess;

/**
 * @covers \VinaiKopp\CurrencyInfo\StaticAccess\CurrencyInfoResourcesDir
 */
class CurrencyInfoResourcesDirTest extends \PHPUnit_Framework_TestCase
{
    public function testReturnsTheResourcesDirectoryPath()
    {
        $this->assertSame(realpath(__DIR__ . '/../../../resources'), CurrencyInfoResourcesDir::get());
    }
}
