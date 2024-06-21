<?php

namespace App\Contracts\Entity;

interface TaxInterface
{
    public function getId(): ?int;
    public function setId(?int $id): void;
    public function getPattern(): string;
    public function setPattern(string $pattern): void;
    public function getTaxPercent(): float;
    public function setTaxPercent(float $taxPercent): void;
}