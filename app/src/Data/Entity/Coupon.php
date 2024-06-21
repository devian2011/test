<?php

namespace App\Data\Entity;

use App\Contracts\Entity\CouponInterface;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\Table;

#[Entity]
#[Table(name: "coupons")]
class Coupon implements CouponInterface
{

    private const PERCENT_CALC_TYPE = 1;
    private const FIXED_CALC_TYPE = 2;

    #[Id]
    #[GeneratedValue]
    #[Column]
    private ?int $id;

    #[Column(name: "code", type: "string", nullable: false, unique: true)]
    private string $code;

    #[Column(name: "value", nullable: false)]
    private float $value = 0.0;

    #[Column(name: "type", nullable: false)]
    private int $type = self::PERCENT_CALC_TYPE;

    #[ManyToOne(targetEntity: Seller::class, inversedBy: "coupons")]
    private Seller $seller;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function setCode(string $code): void
    {
        $this->code = $code;
    }

    public function getValue(): float
    {
        return $this->value;
    }

    public function setValue(float $value): void
    {
        $this->value = $value;
    }

    public function getSeller(): Seller
    {
        return $this->seller;
    }

    public function setSeller(Seller $seller): void
    {
        $this->seller = $seller;
    }

    public function isPercent(): bool
    {
        return $this->type === self::PERCENT_CALC_TYPE;
    }

    public function isFixed(): bool
    {
        return $this->type === self::FIXED_CALC_TYPE;
    }
}