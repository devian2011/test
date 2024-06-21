<?php

namespace App\Data\Repository;

use App\Contracts\Entity\CouponInterface;
use App\Contracts\Repository\CouponRepositoryInterface;
use App\Data\Entity\Coupon;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class CouponRepository extends ServiceEntityRepository implements CouponRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Coupon::class);
    }

    public function findByCode(string $code): ?CouponInterface
    {
        return $this->findOneBy(['code' => $code]);
    }
}