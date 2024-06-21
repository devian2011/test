<?php

namespace App\Service\Price;

use App\Contracts\Repository\CouponRepositoryInterface;
use Psr\Log\LoggerInterface;

interface DiscountCalculatorInterface
{
    public function apply(float $price, string $code): float;
}