<?php

namespace App\Extension\Validator;

use App\Service\Price\TaxFinderInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

#[\Attribute]
class Tax extends Constraint
{

}