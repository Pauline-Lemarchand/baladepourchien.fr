<?php

namespace App\Entity;

use App\Repository\GroupesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    #[ORM\ManyToMany(targetEntity: Users::class, mappedBy: 'groupe')]
    private Collection $user;

    public function __construct()
    {
        $this->user = new ArrayCollection();
    }

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

    /**
     * @return Collection<int, Users>
     */
    public function getUser(): Collection
    {
        return $this->user;
    }

    public function addUser(Users $user): self
    {
        if (!$this->user->contains($user)) {
            $this->user->add($user);
            $user->addGroupe($this);
        }

        return $this;
    }

    public function removeUser(Users $user): self
    {
        if ($this->user->removeElement($user)) {
            $user->removeGroupe($this);
        }

        return $this;
    }
}
