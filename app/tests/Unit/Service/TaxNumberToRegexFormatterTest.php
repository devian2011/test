<?php

namespace Unit\Service;

use App\Service\Price\TaxNumberToRegexFormatter;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class TaxNumberToRegexFormatterTest extends KernelTestCase
{
    private TaxNumberToRegexFormatter $formatter;

    public function setUp(): void
    {
        $this->formatter = new TaxNumberToRegexFormatter();
    }

    public function regexData()
    {
        return [
            ['FRXXYX\YX\X', '/^FR[0-9]{2}[A-z]{1}[0-9]{1}Y[0-9]{1}X$/'],
            ['FRXXYXYXX', '/^FR[0-9]{2}[A-z]{1}[0-9]{1}[A-z]{1}[0-9]{2}$/'],
            ['XXXXX', '/^[0-9]{5}$/'],
            ['XXXUDYYY', '/^[0-9]{3}UD[A-z]{3}$/'],
        ];
    }

    /**
     * @dataProvider regexData
     */
    public function testToRegex($pattern, $result)
    {
        $this->assertEquals($result, $this->formatter->toRegex($pattern));
    }
}
