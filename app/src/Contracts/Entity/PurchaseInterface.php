<?php

namespace App\Contracts\Entity;

interface PurchaseInterface
{
    public function getId(): ?int;
    public function setId(?int $id): void;
    public function getTaxNumber(): string;
    public function setTaxNumber(string $taxId): void;
    public function getCouponCode(): string;
    public function setCouponCode(?string $couponCode): void;
    public function getPaymentProcessor(): string;
    public function setPaymentProcessor(string $paymentProcessor): void;
    public function getPrice(): float;
    public function setPrice(float $price): void;
    public function getGoodId(): int;
    public function setGoodId(int $goodId): void;
    public function isPayed(): bool;
    public function setPayed(bool $payed): void;
}