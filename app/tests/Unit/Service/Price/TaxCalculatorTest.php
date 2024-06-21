<?php

namespace Unit\Service\Price;

use App\Contracts\Entity\TaxInterface;
use App\Service\Price\TaxCalculator;
use PHPUnit\Framework\MockObject\MockObject;
use App\Service\Price\TaxFinder;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class TaxCalculatorTest extends KernelTestCase
{
    private TaxCalculator $calculator;

    /** @var MockObject|TaxFinder */
    private MockObject $finder;

    public function setUp(): void
    {
        $this->finder = $this->createMock(TaxFinder::class);
        $this->calculator = new TaxCalculator($this->finder);
    }

    public function testApply()
    {
        $this->finder->method('find')->willReturn(
            new class implements TaxInterface
            {
                public function getId(): ?int
                {
                    return null;
                }

                public function setId(?int $id): void
                {
                    // TODO: Implement setId() method.
                }

                public function getPattern(): string
                {
                    return 'TYX100';
                }

                public function setPattern(string $pattern): void
                {
                    // TODO: Implement setPattern() method.
                }

                public function getTaxPercent(): float
                {
                    return 20.0;
                }

                public function setTaxPercent(float $taxPercent): void
                {
                    // TODO: Implement setTaxPercent() method.
                }

            }
        );

        $price = $this->calculator->apply(100, 'FEX11111');
        $this->assertEquals(120, $price);
    }
}
