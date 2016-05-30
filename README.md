
Build status: [![Build Status](https://travis-ci.org/Vinai/currency-info.svg?branch=master)](https://travis-ci.org/Vinai/currency-info)

# Currency Info

This repository offers an easy way to get the data required to display money values in a given currency.  

## Installation

Install using composer:

```
$ composer require vinaikopp/currency-info "~1.0"
```
or add it manually:

```json
{
    "require": {
        "vinaikopp/currency-info": "~1.0"
    }
}
```

## Usage

For example, to display a money value with the default number of fraction digits, something like this could be used:

```php
use VinaiKopp\CurrencyInfo\CurrencyInfo;

$currency = 'EUR';
$locale = 'en_US';
$formatter = new \NumberFormatter($locale, \NumberFormatter::CURRENCY);
$decimalPlaces = CurrencyInfo::getFractionDigitsForCurrency($currency);
$formatter->setAttribute(\NumberFormatter::FRACTION_DIGITS, $decimalPlaces);

echo $formatter->formatCurrency($value, $currency);

```

## What it is not

This package does not offer capabilities to do money calculations or currency conversions.
If you need that, I suggest using [mathiasverraes/money](https://github.com/moneyphp/money).  

## Where does the data come from?

The map is based on the [LocalePlanet Currency Map](http://www.localeplanet.com/api/auto/currencymap.html).  
Thanks for their epic efforts!!
