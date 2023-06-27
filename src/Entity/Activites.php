<?php

namespace App\Entity;

use App\Repository\ActivitesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    #[ORM\ManyToMany(targetEntity: Balades::class, mappedBy: 'activite')]
    private Collection $balade;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $emoji = null;

    public function __construct()
    {
        $this->balade = new ArrayCollection();
    }

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
            $balade->addActivite($this);
        }

        return $this;
    }

    public function removeBalade(Balades $balade): self
    {
        if ($this->balade->removeElement($balade)) {
            $balade->removeActivite($this);
        }

        return $this;
    }

    public function getEmoji(): ?string
    {
        return $this->emoji;
    }

    public function setEmoji(?string $emoji): self
    {
        $this->emoji = $emoji;

        return $this;
    }
}
