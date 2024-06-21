<?php

namespace App\UseCase\Purchase;

class PurchaseResult implements PurchaseResultInterface
{

    public function __construct(
        private readonly int  $purchaseId,
        private readonly bool $payed = false
    )
    {

    }

    public function getPurchaseId(): ?int
    {
        return $this->purchaseId;
    }

    public function getPayed(): bool
    {
        return $this->payed;
    }
}
