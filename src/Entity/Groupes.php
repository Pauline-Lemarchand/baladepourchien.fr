<?php

namespace App\Entity;

use App\Repository\GroupesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GroupesRepository::class)]
class Groupes
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nameGroupe = null;

    #[ORM\Column(length: 255)]
    private ?string $areaGroupe = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameGroupe(): ?string
    {
        return $this->nameGroupe;
    }

    public function setNameGroupe(string $nameGroupe): self
    {
        $this->nameGroupe = $nameGroupe;

        return $this;
    }

    public function getAreaGroupe(): ?string
    {
        return $this->areaGroupe;
    }

    public function setAreaGroupe(string $areaGroupe): self
    {
        $this->areaGroupe = $areaGroupe;

        return $this;
    }
}
