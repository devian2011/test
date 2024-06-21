<?php

namespace App\Service\Payment;

interface PaymentProcessorInterface
{

    public function getCode(): string;

    /**
     * @param float $price
     * @return bool
     * @throws \Throwable
     */
    public function pay(float $price): bool;
}