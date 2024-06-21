<?php

namespace App\UseCase\Good;

use App\Contracts\Entity\GoodInterface;
use App\Contracts\Repository\GoodRepositoryInterface;

interface GoodFinderInterface
{
    public function findById(int $id): GoodInterface;
}
