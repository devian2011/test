<?php

namespace App\UseCase\Purchase;

interface PurchaseResultInterface
{
    public function getPurchaseId(): ?int;
    public function getPayed(): bool;
}
