<?php

namespace App\Entity;

use App\Repository\ConseilsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ConseilsRepository::class)]
class Conseils
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titleConseil = null;

    #[ORM\Column(length: 255)]
    private ?string $textConseil = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $photoConseil = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitleConseil(): ?string
    {
        return $this->titleConseil;
    }

    public function setTitleConseil(string $titleConseil): self
    {
        $this->titleConseil = $titleConseil;

        return $this;
    }

    public function getTextConseil(): ?string
    {
        return $this->textConseil;
    }

    public function setTextConseil(string $textConseil): self
    {
        $this->textConseil = $textConseil;

        return $this;
    }

    public function getPhotoConseil(): ?string
    {
        return $this->photoConseil;
    }

    public function setPhotoConseil(?string $photoConseil): self
    {
        $this->photoConseil = $photoConseil;

        return $this;
    }
}
