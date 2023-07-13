<?php

namespace App\Entity;

use App\Entity\Balades;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\DangersRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Twig\Extra\Intl\IntlExtension;

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

    // #[ORM\ManyToMany(targetEntity: Balades::class, mappedBy: 'danger')]
    // private Collection $balade;

    #[ORM\Column(length: 255)]
    private ?string $lat_danger = null;

    #[ORM\Column(length: 255)]
    private ?string $lng_danger = null;

    #[ORM\Column(type: 'datetime_immutable')]
    #[Assert\NotNull()]
    private ?\DateTimeImmutable $createAt = null;

    // public function __construct()
    // {
    //     $this->balade = new ArrayCollection();
    // }
    public function __construct()
    {
        $this->createAt = new \DateTimeImmutable();
    }

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

    public function getLatDanger(): ?string
    {
        return $this->lat_danger;
    }

    public function setLatDanger(string $lat_danger): self
    {
        $this->lat_danger = $lat_danger;

        return $this;
    }

    public function getLngDanger(): ?string
    {
        return $this->lng_danger;
    }

    public function setLngDanger(string $lng_danger): self
    {
        $this->lng_danger = $lng_danger;

        return $this;
    }

    public function getCreateAt(): ?\DateTimeImmutable
    {
        return $this->createAt;
    }

    public function setCreateAt(\DateTimeImmutable $createAt): self
    {
        $this->createAt = $createAt;

        return $this;
    }

}
