<?php

namespace App\Entity;

use App\Repository\DogsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DogsRepository::class)]
class Dogs
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nameDog = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $photoDog = null;

    #[ORM\Column(length: 255)]
    private ?string $raceDog = null;

    #[ORM\Column(length: 255)]
    private ?string $descriptionDog = null;

    #[ORM\Column(length: 255)]
    private ?string $ageDog = null;

    #[ORM\ManyToOne(inversedBy: 'dog')]
    private ?Users $user = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameDog(): ?string
    {
        return $this->nameDog;
    }

    public function setNameDog(string $nameDog): self
    {
        $this->nameDog = $nameDog;

        return $this;
    }

    public function getPhotoDog(): ?string
    {
        return $this->photoDog;
    }

    public function setPhotoDog(?string $photoDog): self
    {
        $this->photoDog = $photoDog;

        return $this;
    }

    public function getRaceDog(): ?string
    {
        return $this->raceDog;
    }

    public function setRaceDog(string $raceDog): self
    {
        $this->raceDog = $raceDog;

        return $this;
    }

    public function getDescriptionDog(): ?string
    {
        return $this->descriptionDog;
    }

    public function setDescriptionDog(string $descriptionDog): self
    {
        $this->descriptionDog = $descriptionDog;

        return $this;
    }

    public function getAgeDog(): ?string
    {
        return $this->ageDog;
    }

    public function setAgeDog(string $ageDog): self
    {
        $this->ageDog = $ageDog;

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
}
