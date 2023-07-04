<?php

namespace App\Entity;

use App\Repository\UsersRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UsersRepository::class)]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class Users implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 255)]
    private ?string $nameUser = null;

    #[ORM\Column(length: 255)]
    private ?string $firstnameUser = null;

    #[ORM\Column]
    private ?string $phoneUser = null;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Dogs::class)]
    private Collection $dog;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Balades::class)]
    private Collection $balade;

    #[ORM\ManyToMany(targetEntity: Groupes::class, inversedBy: 'user')]
    private Collection $groupe;

    public function __construct()
    {
        $this->dog = new ArrayCollection();
        $this->balade = new ArrayCollection();
        $this->groupe = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    
    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getNameUser(): ?string
    {
        return $this->nameUser;
    }

    public function setNameUser(string $nameUser): self
    {
        $this->nameUser = $nameUser;

        return $this;
    }

    public function getFirstnameUser(): ?string
    {
        return $this->firstnameUser;
    }

    public function setFirstnameUser(string $firstnameUser): self
    {
        $this->firstnameUser = $firstnameUser;

        return $this;
    }

    public function getPhoneUser(): ?string
    {
        return $this->phoneUser;
    }

    public function setPhoneUser(string $phoneUser): self
    {
        $this->phoneUser = $phoneUser;

        return $this;
    }

    /**
     * @return Collection<int, Dogs>
     */
    public function getDog(): Collection
    {
        return $this->dog;
    }

    public function addDog(Dogs $dog): self
    {
        if (!$this->dog->contains($dog)) {
            $this->dog->add($dog);
            $dog->setUser($this);
        }

        return $this;
    }

    public function removeDog(Dogs $dog): self
    {
        if ($this->dog->removeElement($dog)) {
            // set the owning side to null (unless already changed)
            if ($dog->getUser() === $this) {
                $dog->setUser(null);
            }
        }

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
            $balade->setUser($this);
        }

        return $this;
    }

    public function removeBalade(Balades $balade): self
    {
        if ($this->balade->removeElement($balade)) {
            // set the owning side to null (unless already changed)
            if ($balade->getUser() === $this) {
                $balade->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Groupes>
     */
    public function getGroupe(): Collection
    {
        return $this->groupe;
    }

    public function addGroupe(Groupes $groupe): self
    {
        if (!$this->groupe->contains($groupe)) {
            $this->groupe->add($groupe);
        }

        return $this;
    }

    public function removeGroupe(Groupes $groupe): self
    {
        $this->groupe->removeElement($groupe);

        return $this;
    }
}
