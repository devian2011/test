<?php

namespace App\UseCase\Good;

use App\Contracts\Repository\GoodRepositoryInterface;
use App\Service\Price\DiscountCalculatorInterface;
use App\Service\Price\TaxCalculatorInterface;


class PriceCalculation  implements PriceCalculationInterface
{
    /**
     * @param GoodRepositoryInterface $goodRepository
     * @param DiscountCalculatorInterface $discountCalculator
     * @param TaxCalculatorInterface $taxCalculator
     */
    public function __construct(
        private readonly GoodFinderInterface $goodFinder,
        private readonly DiscountCalculatorInterface $discountCalculator,
        private readonly TaxCalculatorInterface $taxCalculator)
    {
    }


    public function calculate(PriceCalculationDataInterface $data): float
    {
        $good = $this->goodFinder->findById($data->getProductId());
        $result = $good->getPrice();
        if(!empty($data->getCouponCode())) {
            $result = $this->discountCalculator->apply($result, $data->getCouponCode());
        }
        if($result <= 0) {
            throw new WrongPriceException("price must be gt 0");
        }

        return $this->taxCalculator->apply($result, $data->getTaxNumber());
    }
}
