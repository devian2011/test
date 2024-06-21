<?php

namespace App\UseCase\Purchase;

use App\Contracts\Repository\PurchaseRepositoryInterface;
use App\Data\Entity\Purchase;
use App\Service\Payment\PaymentFactory;
use App\UseCase\Good\PriceCalculationInterface;

class PurchaseService implements PurchaseServiceInterface
{
    public function __construct(
        private readonly PriceCalculationInterface $calculation,
        private readonly PaymentFactory $paymentFactory,
        private readonly PurchaseRepositoryInterface $repository
    )
    {

    }

    public function process(PurchaseInterface $purchase): PurchaseResultInterface
    {
        $price = $this->calculation->calculate($purchase);

        $pData = new Purchase();
        $pData->setGoodId($purchase->getProductId());
        $pData->setPrice($price);
        $pData->setPaymentProcessor($purchase->getPaymentProvider());
        $pData->setTaxNumber($purchase->getTaxNumber());
        $pData->setCouponCode($purchase->getCouponCode());
        $pData->setPayed(false);

        $this->repository->save($pData);

        $paymentResult = $this->paymentFactory->getProcessor($purchase->getPaymentProvider())->pay($price);
        if($paymentResult) {
            $pData->setPayed(true);
        }

        $this->repository->save($pData);

        return new PurchaseResult(
            $pData->getId(),
            $paymentResult
        );
    }
}