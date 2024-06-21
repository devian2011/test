<?php

namespace App\Contracts\Entity;

interface CouponInterface
{
    public function getId(): ?int;
    public function setId(?int $id): void;
    public function getCode(): string;
    public function setCode(string $code): void;
    public function getValue(): float;
    public function setValue(float $value): void;
    public function isPercent(): bool;
    public function isFixed(): bool;
}