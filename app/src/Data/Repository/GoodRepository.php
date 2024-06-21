<?php

namespace App\Data\Repository;

use App\Contracts\Entity\GoodInterface;
use App\Contracts\Repository\GoodRepositoryInterface;
use App\Data\Entity\Good;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class GoodRepository extends ServiceEntityRepository implements GoodRepositoryInterface
{
    public function __construct(ManagerRegistry $managerRegistry)
    {
        parent::__construct($managerRegistry, Good::class);
    }

    public function findById(int $id): ?GoodInterface
    {
        return $this->find($id);
    }
}