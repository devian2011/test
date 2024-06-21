<?php

namespace App\Service\Payment\Processors;

use App\Service\Payment\PaymentProcessorInterface;
use Systemeio\TestForCandidates\PaymentProcessor\StripePaymentProcessor;

class StripePaymentProcessorAdapter implements PaymentProcessorInterface
{
    private StripePaymentProcessor $processor;

    public function __construct()
    {
        $this->processor = new StripePaymentProcessor();
    }

    public function getCode(): string
    {
        return 'stripe';
    }

    public function pay(float $price): bool
    {
        return $this->processor->processPayment($price);
    }
}
