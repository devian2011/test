<?php

namespace App\Extension\Validator;

use App\Contracts\Repository\GoodRepositoryInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class GoodValidator extends ConstraintValidator
{
    public function __construct(
        private readonly GoodRepositoryInterface $repository
    )
    {

    }

    public function validate(mixed $value, Constraint $constraint)
    {
        $product = $this->repository->findById($value);
        if(empty($product)) {
            $this->context->addViolation('unknown product with id: ' . $value);
        }
    }


}