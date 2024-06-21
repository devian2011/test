<?php

namespace App\Extension\Validator;

use App\Service\Payment\PaymentFactory;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;


class PaymentProviderValidator extends ConstraintValidator
{
    public function __construct(
        private readonly PaymentFactory $factory
    )
    {

    }

    public function validate(mixed $value, Constraint $constraint)
    {
        $codes = $this->factory->getProcessorsCodes();
        if(!in_array($value, $codes, true)) {
            $this->context->addViolation(
                sprintf(
                    'Wrong payment provider \'%s\' allowed: %s',
                    $value,
                    implode(',', $codes)
                )
            );
        }
    }


}