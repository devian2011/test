<?php

namespace App\Service\Price;

use App\Contracts\Repository\TaxRepositoryInterface;
use App\Service\Price\TaxFinder;

class TaxCalculator implements TaxCalculatorInterface
{
    private array $taxes = [];

    public function __construct(
        private readonly TaxFinderInterface $finder
    )
    {
    }

    public function apply(float $price, string $taxNumber): float
    {
        $tax = $this->finder->find($taxNumber);
        return $price + ($price * ($tax->getTaxPercent() / 100));
    }
}
