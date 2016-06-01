<?php

namespace VinaiKopp\CurrencyInfo\Build;

class CurrencyInfoSource
{
    /**
     * @var array[]
     */
    private $source;

    /**
     * @param array[] $source
     */
    public function __construct(array $source)
    {
        $this->source = $source;
    }

    /**
     * @param string $fileName
     * @return CurrencyInfoSource
     */
    public static function fromFile($fileName)
    {
        return self::fromJson(file_get_contents($fileName));
    }

    /**
     * @param string $json
     * @return CurrencyInfoSource
     */
    public static function fromJson($json)
    {
        $source = json_decode($json, true);
        if (json_last_error() !== \JSON_ERROR_NONE) {
            throw new \InvalidArgumentException('Input has to be a JSON encoded currency info object');
        }
        return new self($source);
    }

    public function get()
    {
        return $this->source;
    }
}
