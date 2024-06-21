<?php

namespace App\Service\Payment;

interface PaymentFactoryInterface
{
    /**
     * @return string[]
     */
    public function getProcessorsCodes(): array;
    public function getProcessor(string $code): PaymentProcessorInterface;
}
