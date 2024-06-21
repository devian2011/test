<?php

namespace App\Extension\Validator;

use App\Service\Price\TaxFinderInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class TaxValidator extends ConstraintValidator
{
    public function __construct(
        private readonly TaxFinderInterface $finder
    )
    {

    }

    public function validate(mixed $value, Constraint $constraint)
    {
        try {
            $this->finder->find($value);
        } catch (\Throwable $throwable) {
            $this->context->addViolation('Wrong tax number: ' . $value);
        }
    }
}