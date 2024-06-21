<?php

namespace App\Extension\Validator;

use App\Contracts\Repository\CouponRepositoryInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class CouponValidator extends ConstraintValidator
{
    public function __construct(
        private readonly CouponRepositoryInterface $repository
    )
    {

    }

    public function validate(mixed $value, Constraint $constraint)
    {
        if(empty($value)) {
            return;
        }

        $result = $this->repository->findByCode($value);
        if(empty($result)) {
            $this->context->addViolation('wrong coupon code: ' . $value);
        }
    }


}