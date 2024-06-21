<?php

namespace App\Service\Payment;

use Symfony\Component\DependencyInjection\Attribute\AutowireIterator;

class PaymentFactory implements PaymentFactoryInterface
{

    private array $processors = [];

    public function __construct(#[AutowireIterator('app.payment_processor')] iterable $processors = [])
    {

        foreach ($processors as $processor) {
            if(!$processor instanceof PaymentProcessorInterface) {
                throw new PaymentException(
                    sprintf("Wrong payment processor. Expected: %s - Class: %s",
                    PaymentProcessorInterface::class,
                    get_class($processor)
                    )
                );
            }
            if(isset($this->processors[$processor->getCode()])) {
                throw new PaymentException(sprintf(
                    "Processor with code: '%s' already existed. Exists: %s Put: %s",
                    $processor->getCode(),
                    get_class($this->processors[$processor->getCode()]),
                    get_class($processor)
                ));
            }
            $this->processors[$processor->getCode()] = $processor;
        }
    }

    public function getProcessorsCodes(): array
    {
        return array_keys($this->processors);
    }

    public function getProcessor(string $code): PaymentProcessorInterface
    {
        if(!isset($this->processors[$code])) {
            throw new UnknownPaymentProcessorException("Unknown payment processor with code: " . $code);
        }

        return $this->processors[$code];
    }
}
