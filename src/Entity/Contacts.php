<?php

namespace App\Entity;

use App\Repository\ContactsRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: ContactsRepository::class)]
class Contacts
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nameContact = null;

    #[ORM\Column(length: 255)]
    private ?string $firstnameContact = null;

    #[ORM\Column(length: 20)]
    private ?string $reasonContact = null;

    #[ORM\Column(length: 255)]
    private ?string $messageContact = null;


    #[ORM\Column(type: 'datetime_immutable')]
    #[Assert\NotNull()]
    private ?\DateTimeImmutable $createAt = null;

    #[ORM\Column]
    private ?bool $RGPD = null;

   
    public function __construct()
    {
        $this->createAt = new \DateTimeImmutable();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameContact(): ?string
    {
        return $this->nameContact;
    }

    public function setNameContact(string $nameContact): self
    {
        $this->nameContact = $nameContact;

        return $this;
    }

    public function getFirstnameContact(): ?string
    {
        return $this->firstnameContact;
    }

    public function setFirstnameContact(string $firstnameContact): self
    {
        $this->firstnameContact = $firstnameContact;

        return $this;
    }

    public function getReasonContact(): ?string
    {
        return $this->reasonContact;
    }

    public function setReasonContact(string $reasonContact): self
    {
        $this->reasonContact = $reasonContact;

        return $this;
    }

    public function getMessageContact(): ?string
    {
        return $this->messageContact;
    }

    public function setMessageContact(string $messageContact): self
    {
        $this->messageContact = $messageContact;

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

    public function isRGPD(): ?bool
    {
        return $this->RGPD;
    }

    public function setRGPD(bool $RGPD): self
    {
        $this->RGPD = $RGPD;

        return $this;
    }
}
