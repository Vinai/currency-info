
Build status: [![Build Status](https://travis-ci.org/Vinai/currency-info.svg?branch=master)](https://travis-ci.org/Vinai/currency-info)

# Currency Info

This repository offers an easy way to get the data required to display money values in a given currency.
  
Sometimes a currency package that provides all things about currency is overkill, when all you want to do is display a currency.  
PHP can natively nicely format currency values, but it doesn't know about the default fraction digits for example.  
This is what this package can be used for. It does not provide any functionality in regards to conversion or division or such.  
All it does it is provides some information about a given currency.

## Installation

Install using composer:

```
$ composer require vinaikopp/currency-info "^2.0.0"
```
or add it manually:

```json
{
    "require": {
        "vinaikopp/currency-info": "^2.0.0"
    }
}
```

## Usage

For example, to display a money value with the default number of fraction digits, something like this could be used:

```php
use VinaiKopp\CurrencyInfo\StaticAccess\CurrencyInfo;

$currency = 'EUR';
$locale = 'en_US';
$formatter = new \NumberFormatter($locale, \NumberFormatter::CURRENCY);
$decimalPlaces = CurrencyInfo::getFractionDigitsForCurrency($currency);
$formatter->setAttribute(\NumberFormatter::FRACTION_DIGITS, $decimalPlaces);

echo $formatter->formatCurrency($value, $currency);

```

If you use an Dependency Injection Container and would like an instance you can inject,
you can use `\VinaiKopp\CurrencyInfo\CurrencyInfo` for that purpose.

## What it is not

This package does not offer capabilities to do money calculations or currency conversions.
If you need that, I suggest using [mathiasverraes/money](https://github.com/moneyphp/money).  

## Where does the data come from?

The map is based on the [LocalePlanet Currency Map](http://www.localeplanet.com/api/auto/currencymap.html).  
Thanks for their epic efforts!!
