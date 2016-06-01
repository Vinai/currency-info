<?php

namespace VinaiKopp\CurrencyInfo\Build;

/**
 * @covers \VinaiKopp\CurrencyInfo\Build\WriteCurrencyInfoMapFiles
 */
class WriteCurrencyInfoMapFilesTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var string
     */
    private $tmpDir;

    protected function setUp()
    {
        $this->tmpDir = sys_get_temp_dir() . '/' . uniqid('test-');
        $this->createTestDir();
    }

    protected function tearDown()
    {
        if (is_dir($this->tmpDir)) {
            $this->removeTestDir();
        }
    }

    private function createTestDir()
    {
        mkdir($this->tmpDir, 0700, true);
        if (!is_dir($this->tmpDir) || !is_writable($this->tmpDir)) {
            $this->markTestSkipped(sprintf('Unable to write to temporary directory "%s"', $this->tmpDir));
        }
    }

    private function removeTestDir()
    {
        foreach (new \DirectoryIterator($this->tmpDir) as $fileName => $fileInfo) {
            if (!$fileInfo->isDir()) {
                unlink($fileInfo->getRealPath());
            }
        }
        rmdir($this->tmpDir);
    }

    public function testWritesMaps()
    {
        $infoTypeKeys = ['foo', 'bar'];
        $source = [
            ['foo' => 'BAZ', 'bar' => 2],
            ['foo' => 'QUX', 'bar' => 3],
        ];

        /** @var CurrencyInfoKeys|\PHPUnit_Framework_MockObject_MockObject $stubCurrencyInfoKeys */
        $stubCurrencyInfoKeys = $this->getMock(CurrencyInfoKeys::class);
        $stubCurrencyInfoKeys->method('get')->willReturn($infoTypeKeys);

        $mapWriter = new WriteCurrencyInfoMapFiles(new CurrencyInfoSource($source), new \SplFileInfo($this->tmpDir));
        $mapWriter->write($stubCurrencyInfoKeys);

        $this->assertFileExists($this->tmpDir . '/currencymap-foo.php');
        $this->assertFileExists($this->tmpDir . '/currencymap-bar.php');
        $this->assertFileExists($this->tmpDir . '/currencymap.php');
    }
}
