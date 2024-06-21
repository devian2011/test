<?php

namespace App\Service\Price;

use App\Contracts\Repository\CouponRepositoryInterface;
use Psr\Log\LoggerInterface;

class DiscountCalculator implements DiscountCalculatorInterface
{
    public function __construct(
        private readonly CouponRepositoryInterface $couponRepository,
        private readonly LoggerInterface $logger)
    {
    }

    public function apply(float $price, string $code): float
    {
        $coupon = $this->couponRepository->findByCode($code);

        if(!empty($coupon)) {
            $this->logger->debug(sprintf('coupon with code: %s is found', $code));
            if($coupon->isPercent()) {
                $price = $price - ($price * ($coupon->getValue() / 100));
            }elseif ($coupon->isFixed()) {
                $price = $price - $coupon->getValue();
            } else {
                throw new PriceException("Unknown coupon type");
            }

            $this->logger->debug(
                sprintf(
                    'coupon with code %s applied price: %f discount: %d percent',
                    $code,
                    $price,
                    $coupon->getValue()
                )
            );
        } else {
            $this->logger->debug(sprintf('coupon with code: %s is not found', $code));
        }

        return $price;
    }
}