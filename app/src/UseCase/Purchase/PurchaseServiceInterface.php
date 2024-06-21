<?php

namespace App\UseCase\Purchase;

interface PurchaseServiceInterface
{
    /**
     * @param PurchaseInterface $purchase
     * @return int
     */
    public function process(PurchaseInterface $purchase): PurchaseResultInterface;
}