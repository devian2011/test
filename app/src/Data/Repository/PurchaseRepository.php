<?php

namespace App\Data\Repository;

use App\Contracts\Entity\PurchaseInterface;
use App\Contracts\Repository\PurchaseRepositoryInterface;
use App\Data\Entity\Purchase;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class PurchaseRepository extends ServiceEntityRepository implements PurchaseRepositoryInterface
{
    public function __construct(ManagerRegistry $managerRegistry)
    {
        parent::__construct($managerRegistry, Purchase::class);
    }

    public function save(PurchaseInterface $purchase): PurchaseInterface
    {
        $data = null;
        if(!$purchase instanceof Purchase) {

            if(!empty($purchase->getId())) {
                $data = $this->find($purchase->getId());
            }
            if(is_null($data)) {
                $data = new Purchase();
            }

            $data->setId($purchase->getId());
            $data->setTaxNumber($purchase->getTaxNumber());
            $data->setCouponCode($purchase->getCouponCode());
            $data->setPrice($purchase->getPrice());
            $data->setPaymentProcessor($purchase->getPaymentProcessor());
            $data->setGoodId($purchase->getGoodId());
        } else {
            $data = $purchase;
        }

        $this->getEntityManager()->persist($data);
        $this->getEntityManager()->flush();

        return $data;
    }
}