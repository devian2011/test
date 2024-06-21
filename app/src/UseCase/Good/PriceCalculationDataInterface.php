<?php

namespace App\UseCase\Good;

interface PriceCalculationDataInterface
{
    public function getProductId(): int;
    public function getTaxNumber(): string;
    public function getCouponCode(): ?string;
}
