<?php

namespace App\UseCase\Purchase;

use App\UseCase\Good\PriceCalculationDataInterface;

interface PurchaseInterface extends PriceCalculationDataInterface
{
    public function getPaymentProvider(): string;
}