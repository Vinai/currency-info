<?php

namespace VinaiKopp\CurrencyInfo\Build;

use VinaiKopp\CurrencyInfo\Build\CurrencyInfoKeys;

class WriteCurrencyInfoMapFiles
{
    /**
     * @var CurrencyInfoSource
     */
    private $source;

    /**
     * @var \SplFileInfo
     */
    private $outputDir;

    public function __construct(CurrencyInfoSource $source, \SplFileInfo $outputDir)
    {
        $this->source = $source;
        $this->outputDir = $outputDir;
    }

    public function write(CurrencyInfoKeys $currencyInfoKeys)
    {
        $this->writeExport($this->outputDir->getRealPath() . '/currencymap.php', $this->source->get());
        $this->writeSubMaps($currencyInfoKeys);
    }

    private function writeSubMaps(CurrencyInfoKeys $currencyInfoKeys)
    {
        array_map(function ($infoType) {
            $this->writeExport($this->getSubMapFileName($infoType), $this->getSubTypeMap($infoType));
        }, $currencyInfoKeys->get());
    }

    private function getSubMapFileName($infoType)
    {
        return $this->outputDir->getRealPath() . '/currencymap-' . $infoType . '.php';
    }

    private function getSubTypeMap($infoType)
    {
        return CurrencyInfoToSeparateMaps::build($this->source->get(), $infoType);
    }

    private function writeExport($fileName, $dataToWrite)
    {
        file_put_contents($fileName, "<?php\nreturn " . var_export($dataToWrite, true) . ";\n");
    }
}
