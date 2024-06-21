<?php

namespace App\Contracts\Repository;

use App\Contracts\Entity\PurchaseInterface;

interface PurchaseRepositoryInterface
{
    public function save(PurchaseInterface $purchase): PurchaseInterface;
}
