<?php

namespace App\Service\Payment\Processors;

use App\Service\Payment\PaymentProcessorInterface;
use Systemeio\TestForCandidates\PaymentProcessor\PaypalPaymentProcessor;

class PaypalPaymentProcessorAdapter implements PaymentProcessorInterface
{
    private PaypalPaymentProcessor $processor;

    public function __construct()
    {
        $this->processor = new PaypalPaymentProcessor();
    }

    public function getCode(): string
    {
        return 'paypal';
    }

    public function pay(float $price): bool
    {
        $this->processor->pay((int)$price);
        return true;
    }
}