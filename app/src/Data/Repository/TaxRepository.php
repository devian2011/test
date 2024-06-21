<?php

namespace App\Data\Repository;

use App\Contracts\Repository\TaxRepositoryInterface;
use App\Data\Entity\Tax;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class TaxRepository extends ServiceEntityRepository implements TaxRepositoryInterface
{
    public function __construct(ManagerRegistry $managerRegistry)
    {
        parent::__construct($managerRegistry, Tax::class);
    }
}
