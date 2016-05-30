#!/usr/bin/env php
<?php

use VinaiKopp\CurrencyInfo\Build\CurrencyInfoSource;
use VinaiKopp\CurrencyInfo\Build\WriteCurrencyInfoMapFiles;
use VinaiKopp\CurrencyInfo\Build\CurrencyInfoKeys;

require_once __DIR__ . '/../vendor/autoload.php';

$outputDirPath = isset($argv[1]) && is_dir($argv[1]) ? $argv[1] : __DIR__ . '/../resources';
$outputDir = new \SplFileInfo($outputDirPath);

if (!$outputDir->isDir() || !$outputDir->isWritable()) {
    file_put_contents('php://stderr', "Unable to write to directory '{$outputDir}'\n");
    exit(2);
}
$writer = new WriteCurrencyInfoMapFiles(CurrencyInfoSource::fromFile('php://stdin'), $outputDir);
$writer->write(new CurrencyInfoKeys());
