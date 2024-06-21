<?php

namespace App\Data\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\Table;

#[Entity]
#[Table(name: "sellers")]
class Seller
{
    #[Id]
    #[GeneratedValue]
    #[Column]
    private ?int $id = null;

    #[Column(name: "name", type: "string", nullable: false)]
    private $name;

    #[OneToMany(targetEntity: Coupon::class, mappedBy: "seller")]
    private ArrayCollection $coupons;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    public function getCoupons(): ArrayCollection
    {
        return $this->coupons;
    }

    public function setCoupons(ArrayCollection $coupons): void
    {
        $this->coupons = $coupons;
    }
}
