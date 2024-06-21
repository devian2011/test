<?php

namespace App\Contracts\Repository;

use App\Contracts\Entity\CouponInterface;

interface CouponRepositoryInterface
{
    public function findByCode(string $code): ?CouponInterface;
}
