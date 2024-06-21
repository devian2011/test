<?php

namespace App\UseCase\Good;

interface PriceCalculationInterface
{
    public function calculate(PriceCalculationDataInterface $data): float;
}
