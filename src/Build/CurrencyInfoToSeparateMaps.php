<?php

namespace VinaiKopp\CurrencyInfo\Build;

use VinaiKopp\CurrencyInfo\StaticAccess\CurrencyInfo;

class CurrencyInfoToSeparateMaps
{
    /**
     * @param array[] $source
     * @param string $infoType
     * @return string[]
     */
    public static function build(array $source, $infoType)
    {
        return array_column($source, $infoType, CurrencyInfo::CODE);
    }
}
