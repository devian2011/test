<?php

namespace App\Contracts\Repository;

use App\Contracts\Entity\TaxInterface;

interface TaxRepositoryInterface
{
    /**
     * @return TaxInterface[]
     */
    public function findAll(): array;
}