<?php

namespace App\Service\Price;

use App\Contracts\Repository\TaxRepositoryInterface;
use App\Service\Price\TaxFinder;

interface TaxCalculatorInterface
{
    public function apply(float $price, string $taxNumber): float;
}
