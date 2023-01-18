<?php

namespace App\Entity;

use App\Repository\DangersRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DangersRepository::class)]
class Dangers
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $areaDanger = null;

    #[ORM\Column(length: 255)]
    private ?string $nameDanger = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAreaDanger(): ?string
    {
        return $this->areaDanger;
    }

    public function setAreaDanger(string $areaDanger): self
    {
        $this->areaDanger = $areaDanger;

        return $this;
    }

    public function getNameDanger(): ?string
    {
        return $this->nameDanger;
    }

    public function setNameDanger(string $nameDanger): self
    {
        $this->nameDanger = $nameDanger;

        return $this;
    }
}
