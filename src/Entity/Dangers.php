<?php

namespace App\Entity;

use App\Repository\DangersRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    #[ORM\ManyToMany(targetEntity: Balades::class, mappedBy: 'danger')]
    private Collection $balade;

    #[ORM\Column(length: 255)]
    private ?string $lat_danger = null;

    #[ORM\Column(length: 255)]
    private ?string $lng_danger = null;

    public function __construct()
    {
        $this->balade = new ArrayCollection();
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

    /**
     * @return Collection<int, Balades>
     */
    public function getBalade(): Collection
    {
        return $this->balade;
    }

    public function addBalade(Balades $balade): self
    {
        if (!$this->balade->contains($balade)) {
            $this->balade->add($balade);
            $balade->addDanger($this);
        }

        return $this;
    }

    public function removeBalade(Balades $balade): self
    {
        if ($this->balade->removeElement($balade)) {
            $balade->removeDanger($this);
        }

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
}
