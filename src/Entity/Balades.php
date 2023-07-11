<?php

namespace App\Entity;

use App\Repository\BaladesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    #[ORM\Column(length: 255)]
    private ?string $timeBalade = null;

    #[ORM\Column(length: 255)]
    private ?string $areaBalade = null;

    #[ORM\ManyToOne(inversedBy: 'balade')]
    private ?Users $user = null;

    #[ORM\ManyToMany(targetEntity: Activites::class, inversedBy: 'balade')]
    private Collection $activite;

    #[ORM\ManyToMany(targetEntity: Dangers::class, inversedBy: 'balade')]
    private Collection $danger;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $latBalade = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $lngBalade = null;

    public function __construct()
    {
        $this->activite = new ArrayCollection();
       
    }

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

    public function getTimeBalade(): ?string
    {
        return $this->timeBalade;
    }

    public function setTimeBalade(string $timeBalade): self
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

    public function getUser(): ?Users
    {
        return $this->user;
    }

    public function setUser(?Users $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection<int, Activites>
     */
    public function getActivite(): Collection
    {
        return $this->activite;
    }

    public function addActivite(Activites $activite): self
    {
        if (!$this->activite->contains($activite)) {
            $this->activite->add($activite);
        }

        return $this;
    }

    public function removeActivite(Activites $activite): self
    {
        $this->activite->removeElement($activite);

        return $this;
    }

   

    public function getLatBalade(): ?string
    {
        return $this->latBalade;
    }

    public function setLatBalade(?string $latBalade): self
    {
        $this->latBalade = $latBalade;

        return $this;
    }

    public function getLngBalade(): ?string
    {
        return $this->lngBalade;
    }

    public function setLngBalade(?string $lngBalade): self
    {
        $this->lngBalade = $lngBalade;

        return $this;
    }
}
