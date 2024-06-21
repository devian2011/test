<?php

namespace Unit\Service\Price;

use App\Contracts\Entity\TaxInterface;
use App\Contracts\Repository\TaxRepositoryInterface;
use App\Service\Price\TaxNumberToRegexFormatter;
use App\Service\Price\UnknownTaxNumberException;
use PHPUnit\Framework\MockObject\MockObject;
use App\Service\Price\TaxFinder;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class TaxFinderTest extends KernelTestCase
{
    private TaxFinder $finder;

    /** @var MockObject|TaxRepositoryInterface */
    private MockObject $repository;

    private MockObject $formatter;

    public function setUp(): void
    {

        $this->repository = $this->createMock(TaxRepositoryInterface::class);
        $this->formatter = $this->createMock(TaxNumberToRegexFormatter::class);

        $this->finder = new TaxFinder($this->repository, $this->formatter);
    }

    public function testApply()
    {
        $taxData = new class implements TaxInterface
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
        };

        $this->repository->method('findAll')->willReturn([$taxData]);
        $this->formatter->method('toRegex')->willReturn('/.*/');

        $tax = $this->finder->find('FEX11111');
        $this->assertEquals($taxData, $tax);
    }

    public function testApplyFail()
    {
        $this->repository->method('findAll')->willReturn([]);
        $this->expectException(UnknownTaxNumberException::class);
        $this->expectExceptionMessage("Unknown tax number FEX11111");
        $this->finder->find('FEX11111');
    }
}
