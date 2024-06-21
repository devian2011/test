<?php

namespace Unit\Service\Price;

use App\Contracts\Entity\CouponInterface;
use App\Contracts\Repository\CouponRepositoryInterface;
use App\Service\Price\DiscountCalculator;
use PHPUnit\Framework\MockObject\MockObject;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class DiscountCalculatorTest extends KernelTestCase
{
    private DiscountCalculator $calculator;
    /** @var MockObject|CouponRepositoryInterface|(CouponRepositoryInterface&object&MockObject)|(CouponRepositoryInterface&MockObject)|(object&MockObject) */
    private MockObject $couponRepository;


    public function setUp(): void
    {
        $logger = $this->createMock(LoggerInterface::class);

        $this->couponRepository = $this->createMock(CouponRepositoryInterface::class);
        $this->calculator = new DiscountCalculator($this->couponRepository, $logger);
    }

    public function testApply()
    {
        $this->couponRepository->method('findByCode')->willReturn(new class implements CouponInterface
        {
            public function getId(): ?int
            {
                return null;
            }

            public function setId(?int $id): void
            {
                // TODO: Implement setId() method.
            }

            public function getCode(): string
            {
                return 'F10';
            }

            public function setCode(string $code): void
            {
                // TODO: Implement setCode() method.
            }

            public function getValue(): float
            {
                return 10.0;
            }

            public function setValue(float $value): void
            {
                // TODO: Implement setValue() method.
            }

            public function isPercent(): bool
            {
                return false;
            }

            public function isFixed(): bool
            {
                return true;
            }
        });

        $price = $this->calculator->apply(100, 'F10');
        $this->assertEquals(90.0, $price);
    }

    public function testApplyFail()
    {
        $this->couponRepository->method('findByCode')->willReturn(new class implements CouponInterface
        {
            public function getId(): ?int
            {
                return null;
            }

            public function setId(?int $id): void
            {
                // TODO: Implement setId() method.
            }

            public function getCode(): string
            {
                return 'F10';
            }

            public function setCode(string $code): void
            {
                // TODO: Implement setCode() method.
            }

            public function getValue(): float
            {
                return 25;
            }

            public function setValue(float $value): void
            {
                // TODO: Implement setValue() method.
            }

            public function isPercent(): bool
            {
                return true;
            }

            public function isFixed(): bool
            {
                return false;
            }
        });

        $price = $this->calculator->apply(100, 'F10');
        $this->assertEquals(75.0, $price);
    }
}
