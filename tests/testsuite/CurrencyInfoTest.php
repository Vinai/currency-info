<?php

namespace VinaiKopp\CurrencyInfo;

/**
 * @covers \VinaiKopp\CurrencyInfo\CurrencyInfo
 */
class CurrencyInfoTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var array
     */
    private static $staticMethodCalls;

    /**
     * @var mixed
     */
    private static $staticMethodCallReturnValue;

    /**
     * @var CurrencyInfo
     */
    private $currencyInfo;

    private function assertStaticMethodWasCalled($methodName)
    {
        $message = sprintf('Static method "%s" was not called', $methodName);
        $this->assertArrayHasKey($methodName, self::$staticMethodCalls, $message);
    }

    /**
     * @param string $methodName
     * @param mixed[] $expectedArgs
     */
    private function assertStaticMethodWasCalledWithParams($methodName, ...$expectedArgs)
    {
        if (! isset(self::$staticMethodCalls[$methodName])) {
            $this->fail(sprintf('Static method "%s" was not called', $methodName));
        }
        $message = 'Expected static method call arguments do not match';
        $this->assertSame($expectedArgs, self::$staticMethodCalls[$methodName], $message);
    }

    /**
     * @param string $name
     * @param mixed[] $arguments
     * @return mixed
     */
    public static function __callStatic($name, array $arguments)
    {
        self::$staticMethodCalls[$name] = $arguments;
        return self::$staticMethodCallReturnValue;
    }

    protected function setUp()
    {
        self::$staticMethodCalls = [];
        self::$staticMethodCallReturnValue = [];
        $this->currencyInfo = new CurrencyInfo();
        $this->currencyInfo->staticCurrencyInfoClass = __CLASS__;
    }

    public function testImplementsCurrencyInfoInterface()
    {
        $this->assertInstanceOf(CurrencyInfoInterface::class, $this->currencyInfo);
    }

    public function testGetMapIsDelegatedToTheStaticCurrencyInfo()
    {
        self::$staticMethodCallReturnValue = ['dummy' => ['foo' => 'bar']];
        $this->assertSame(self::$staticMethodCallReturnValue, $this->currencyInfo->getMap());
        $this->assertStaticMethodWasCalled('getMap');
    }

    public function testGetMapForCurrencyIsDelegatedToTheStaticCurrencyInfo()
    {
        self::$staticMethodCallReturnValue = ['dummy' => ['buz' => 'qux']];
        $this->assertSame(self::$staticMethodCallReturnValue, $this->currencyInfo->getMapForCurrency('XXX'));
        $this->assertStaticMethodWasCalledWithParams('getMapForCurrency', 'XXX');
    }

    public function testGetSymbolMapIsDelegatedToTheStaticCurrencyInfo()
    {
        self::$staticMethodCallReturnValue = ['foo' => 'bar'];
        $this->assertSame(self::$staticMethodCallReturnValue, $this->currencyInfo->getSymbolMap());
        $this->assertStaticMethodWasCalledWithParams('getSymbolMap');
    }

    public function testGetSymbolForCurrencyIsDelegatedToTheStaticCurrencyInfo()
    {
        self::$staticMethodCallReturnValue = 'BAR';
        $this->assertSame(self::$staticMethodCallReturnValue, $this->currencyInfo->getSymbolForCurrency('YYY'));
        $this->assertStaticMethodWasCalledWithParams('getSymbolForCurrency', 'YYY');
    }

    public function testGetNativeSymbolMapIsDelegatedToTheStaticCurrencyInfo()
    {
        self::$staticMethodCallReturnValue = ['some' => 'map'];
        $this->assertSame(self::$staticMethodCallReturnValue, $this->currencyInfo->getNativeSymbolMap());
        $this->assertStaticMethodWasCalled('getNativeSymbolMap');
    }

    public function testGetNativeSymbolForCurrencyIsDelegatedToTheStaticCurrencyInfo()
    {
        self::$staticMethodCallReturnValue = 'Foo';
        $this->assertSame(self::$staticMethodCallReturnValue, $this->currencyInfo->getNativeSymbolForCurrency('ZZZ'));
        $this->assertStaticMethodWasCalledWithParams('getNativeSymbolForCurrency', 'ZZZ');
    }

    public function testGetFractionDigitMapIsDelegatedToTheStaticCurrencyInfo()
    {
        self::$staticMethodCallReturnValue = ['another' => 'map'];
        $this->assertSame(self::$staticMethodCallReturnValue, $this->currencyInfo->getFractionDigitsMap());
        $this->assertStaticMethodWasCalled('getFractionDigitsMap');
    }

    public function testGetFractionDigitForCurrencyIsDelegatedToTheStaticCurrencyInfo()
    {
        self::$staticMethodCallReturnValue = 'Qux';
        $this->assertSame(self::$staticMethodCallReturnValue, $this->currencyInfo->getFractionDigitsForCurrency('AAA'));
        $this->assertStaticMethodWasCalledWithParams('getFractionDigitsForCurrency', 'AAA');
    }

    public function testGetRoundingMapIsDelegatedToTheStaticCurrencyInfo()
    {
        self::$staticMethodCallReturnValue = ['rounding' => 'stuff'];
        $this->assertSame(self::$staticMethodCallReturnValue, $this->currencyInfo->getRoundingMap());
        $this->assertStaticMethodWasCalled('getRoundingMap');
    }

    public function testGetRoundingForCurrencyIsDelegatedToTheStaticCurrencyInfo()
    {
        self::$staticMethodCallReturnValue = '111';
        $this->assertSame(self::$staticMethodCallReturnValue, $this->currencyInfo->getRoundingForCurrency('BBB'));
        $this->assertStaticMethodWasCalledWithParams('getRoundingForCurrency', 'BBB');
    }
}
