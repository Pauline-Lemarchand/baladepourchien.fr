<?php

namespace App\Entity;

use App\Repository\BaladesRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BaladesRepository::class)]
class Balades
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nameBalade = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $photoBalade = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $timeBalade = null;

    #[ORM\Column(length: 255)]
    private ?string $areaBalade = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameBalade(): ?string
    {
        return $this->nameBalade;
    }

    public function setNameBalade(string $nameBalade): self
    {
        $this->nameBalade = $nameBalade;

        return $this;
    }

    public function getPhotoBalade(): ?string
    {
        return $this->photoBalade;
    }

    public function setPhotoBalade(?string $photoBalade): self
    {
        $this->photoBalade = $photoBalade;

        return $this;
    }

    public function getTimeBalade(): ?\DateTimeInterface
    {
        return $this->timeBalade;
    }

    public function setTimeBalade(\DateTimeInterface $timeBalade): self
    {
        $this->timeBalade = $timeBalade;

        return $this;
    }

    public function getAreaBalade(): ?string
    {
        return $this->areaBalade;
    }

    public function setAreaBalade(string $areaBalade): self
    {
        $this->areaBalade = $areaBalade;

        return $this;
    }
}
