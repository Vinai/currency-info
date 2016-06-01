
Build status: [![Build Status](https://travis-ci.org/Vinai/currency-info.svg?branch=master)](https://travis-ci.org/Vinai/currency-info)

# Currency Info

This repository offers an easy way to get data required to display money values in a given currency:  

* Fraction Digits (e.g. 2 for currencies with 100 subunits like USD)
* Rounding (e.g. 0.05 for currencies like CHF)
* International Symbol (e.g. € for EUR)
* Native Symbol (e.g. $ for USD)

To look up the information the (ISO 4217) three letter currency code, e.g. DKK or EUR).

## Background

Sometimes a currency package that provides all things about currency is overkill. I might just want to render a monetary value.  
PHP can natively nicely format currency values, but it doesn't know about the default fraction digits for example.  
This is what this package can be used for. It does not provide any functionality in regards to conversion or division or such.  
All this package does is provide information about a given currency.

## Installation

Install using composer:

```
$ composer require vinaikopp/currency-info "^2.0.0"
```
Or add it manually to the composer.json file:

```json
{
    "require": {
        "vinaikopp/currency-info": "^2.0.0"
    }
}
```

## Usage

For example, to display a money value with the default number of fraction digits, something like this could be used:

**Example using static methods**
```php
use VinaiKopp\CurrencyInfo\StaticAccess\CurrencyInfo;

$currency = 'EUR';
$locale = 'de_DE';
$formatter = new \NumberFormatter($locale, \NumberFormatter::CURRENCY);
$decimalPlaces = CurrencyInfo::getFractionDigitsForCurrency($currency);
$formatter->setAttribute(\NumberFormatter::FRACTION_DIGITS, $decimalPlaces);

echo $formatter->formatCurrency($value, $currency);

```

If you use an Dependency Injection Container and would like an instance you can inject,
you can use `\VinaiKopp\CurrencyInfo\CurrencyInfo`.

**Example using a currency info instance**
```php
public function __construct(\VinaiKopp\CurrencyInfo\CurrencyInfo $currencyInfo)
{
    $this->currencyInfo = $currencyInfo;
    $this->currency = 'USD';
    $this->locale = 'en_US'
}

public function format($amount)
{
    $formatter = new \NumberFormatter($this->locale, \NumberFormatter::CURRENCY);
    $decimalPlaces = $this->currencyInfo->getFractionDigitsForCurrency($this->currency);
    $formatter->setAttribute(\NumberFormatter::FRACTION_DIGITS, $decimalPlaces);

    return $formatter->formatCurrency($amount, $this->currency);
}
```

## What it is not

This package does not offer capabilities to do money calculations or currency conversions.
If you need that, I suggest using [mathiasverraes/money](https://github.com/moneyphp/money).  

## Where does the data come from?

The map is based on the [LocalePlanet Currency Map](http://www.localeplanet.com/api/auto/currencymap.html).  
Thanks for their epic efforts!!
