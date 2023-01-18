<?php

namespace App\Entity;

use App\Repository\ActivitesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ActivitesRepository::class)]
class Activites
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nameActivite = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameActivite(): ?string
    {
        return $this->nameActivite;
    }

    public function setNameActivite(string $nameActivite): self
    {
        $this->nameActivite = $nameActivite;

        return $this;
    }
}
