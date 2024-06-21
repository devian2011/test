<?php

namespace App\Contracts\Entity;

interface GoodInterface
{
    public function getId(): ?int;
    public function setId(?int $id): void;
    public function getName(): string;
    public function setName(string $name): void;
    public function getPrice(): int;
    public function setPrice(int $price): void;
}
