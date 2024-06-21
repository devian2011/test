<?php

namespace App\Data\Entity;

use App\Contracts\Entity\GoodInterface;
use App\Data\Repository\GoodRepository;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;

#[Entity(repositoryClass: GoodRepository::class)]
#[Table(name: "goods")]
class Good implements GoodInterface
{

    #[Id]
    #[GeneratedValue]
    #[Column]
    private ?int $id = null;

    #[Column(name: "name", type: "string",  nullable: false)]
    private string $name;

    #[Column(name: "price", type: "float", nullable: false)]
    private float $price;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getPrice(): int
    {
        return $this->price;
    }

    public function setPrice(int $price): void
    {
        $this->price = $price;
    }
}
