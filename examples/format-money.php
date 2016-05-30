<?php

use VinaiKopp\CurrencyInfo\CurrencyInfo;

require __DIR__ . '/../vendor/autoload.php';

class CurrencyFormatter
{
    /** @var  string */
    private $currencyCode;

    /** @var  string */
    private $locale;

    public function __construct($currencyCode, $localeCode)
    {
        $this->currencyCode = $currencyCode;
        $this->locale = $localeCode;
    }

    public function format($amount)
    {
        return $this->getFormatter()->formatCurrency($amount, $this->currencyCode);
    }

    private function getFormatter()
    {
        $formatter = new \NumberFormatter($this->locale, \NumberFormatter::CURRENCY);
        $decimalPlaces = CurrencyInfo::getFractionDigitsForCurrency($this->currencyCode);
        $formatter->setAttribute(\NumberFormatter::FRACTION_DIGITS, $decimalPlaces);
        return $formatter;
    }
}

echo "---------------\n";
$deEuroFormatter = new CurrencyFormatter('EUR', 'de_DE');
echo 'de_DE/EUR: ' . $deEuroFormatter->format(123456.78) . PHP_EOL;

$usEuroFormatter = new CurrencyFormatter('EUR', 'en_US');
echo 'en_US/EUR: ' . $usEuroFormatter->format(123456.78) . PHP_EOL;
echo "---------------\n";
$deYenFormatter = new CurrencyFormatter('JPY', 'de_DE');
echo 'de_DE/JPY: ' . $deYenFormatter->format(123456.78) . PHP_EOL;

$usYenFormatter = new CurrencyFormatter('JPY', 'en_US');
echo 'en_US/JPY: ' . $usYenFormatter->format(123456.78) . PHP_EOL;
echo "---------------\n";

// Output:
//---------------
//de_DE/EUR: 123.456,78 €
//en_US/EUR: €123,456.78
//---------------
//de_DE/JPY: 123.457 ¥
//en_US/JPY: ¥123,457
