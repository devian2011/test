<?php

namespace App\Contracts\Repository;

use App\Contracts\Entity\GoodInterface;

interface GoodRepositoryInterface
{
    public function findById(int $id): ?GoodInterface;
}
