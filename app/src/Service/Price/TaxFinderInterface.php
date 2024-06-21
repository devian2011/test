<?php

namespace App\Service\Price;

use App\Contracts\Entity\TaxInterface;
use App\Contracts\Repository\TaxRepositoryInterface;
use App\Service\Price\TaxNumberToRegexFormatter;

interface TaxFinderInterface
{
    public function find(string $taxNumber): TaxInterface;
}
