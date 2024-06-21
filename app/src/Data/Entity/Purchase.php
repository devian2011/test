<?php

namespace App\Data\Entity;

use App\Contracts\Entity\GoodInterface;
use App\Contracts\Entity\PurchaseInterface;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\Table;

#[Entity]
#[Table(name: "purchases")]
class Purchase implements PurchaseInterface
{
    #[Id]
    #[GeneratedValue]
    #[Column]
    private ?int $id;

    #[Column(name: "tax_number", nullable: false)]
    private string $taxNumber;

    #[Column(name: "coupon", nullable: true)]
    private ?string $couponCode;

    #[Column(name: "payment_processor", nullable: false)]
    private string $paymentProcessor;

    #[Column(name: "price", nullable: false)]
    private float $price;

    #[Column(name: "good_id", nullable: false)]
    private int $goodId;

    #[Column(name: "payed")]
    private bool $payed = false;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getTaxNumber(): string
    {
        return $this->taxNumber;
    }

    public function setTaxNumber(string $taxId): void
    {
        $this->taxNumber = $taxId;
    }

    public function getCouponCode(): string
    {
        return $this->couponCode;
    }

    public function setCouponCode(?string $couponCode): void
    {
        $this->couponCode = $couponCode;
    }

    public function getPaymentProcessor(): string
    {
        return $this->paymentProcessor;
    }

    public function setPaymentProcessor(string $paymentProcessor): void
    {
        $this->paymentProcessor = $paymentProcessor;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    public function getGoodId(): int
    {
        return $this->goodId;
    }

    public function setGoodId(int $goodId): void
    {
        $this->goodId = $goodId;
    }

    public function isPayed(): bool
    {
        return $this->payed;
    }

    public function setPayed(bool $payed): void
    {
        $this->payed = $payed;
    }
}