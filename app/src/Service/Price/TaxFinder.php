<?php

namespace App\Service\Price;

use App\Contracts\Entity\TaxInterface;
use App\Contracts\Repository\TaxRepositoryInterface;

class TaxFinder implements TaxFinderInterface
{
    private array $taxes = [];

    public function __construct(
        private readonly TaxRepositoryInterface $repository,
        private readonly TaxNumberToRegexFormatter $formatter)
    {
    }

    public function find(string $taxNumber): TaxInterface
    {
        if(empty($this->taxes)) {
            $this->taxes = $this->repository->findAll();
        }

        foreach ($this->taxes as $tax) {
            $regex = $this->formatter->toRegex($tax->getPattern());
            if(preg_match($regex, $taxNumber)) {
                return $tax;
            }
        }

        throw new UnknownTaxNumberException(sprintf("Unknown tax number %s", $taxNumber));
    }
}
