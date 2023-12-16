<?php

namespace App\Entity;

use App\Repository\OsobaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Psr\Log\LoggerInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: OsobaRepository::class)]
class Osoba
{


    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $jmeno = null;

    #[ORM\Column(length: 255)]
    private ?string $prijmeni = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $datum_narozeni = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $heslo = null;

    #[ORM\ManyToMany(targetEntity: Role::class, inversedBy: 'osobas')]
    #[ORM\JoinTable(name: 'osoba_role')]
    #[ORM\JoinColumn(name: 'osoba_id', referencedColumnName: 'id')]
    #[ORM\InverseJoinColumn(name: 'role_id', referencedColumnName: 'id')]
    private Collection $roles;




    public function __construct()
    {
        $this->roles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getJmeno(): ?string
    {
        return $this->jmeno;
    }

    public function setJmeno(string $jmeno): static
    {
        $this->jmeno = $jmeno;

        return $this;
    }

    public function getPrijmeni(): ?string
    {
        return $this->prijmeni;
    }

    public function setPrijmeni(string $prijmeni): static
    {
        $this->prijmeni = $prijmeni;

        return $this;
    }

    public function getDatumNarozeni(): ?\DateTimeInterface
    {
        return $this->datum_narozeni;
    }

    public function setDatumNarozeni(\DateTimeInterface $datum_narozeni): static
    {
        $this->datum_narozeni = $datum_narozeni;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getHeslo(): ?string
    {
        return $this->heslo;
    }

    public function setHeslo(string $heslo): static
    {
        $this->heslo = $heslo;

        return $this;
    }

    /**
     * @return Role[]
     */
    public function getRoles(): array
    {
        return $this->roles->toArray();
    }

        /**
     * @return string[]
     */
    public function getRoleStrings(): array
    {
        return $this->roles->map(function ($role) {
            return (string) $role;
        })->toArray();
    }

    public function addRole(Role $role): self
    {
        if (!$this->roles->contains($role)) {
            $this->roles[] = $role;
        }

        return $this;
    }

    public function removeRole(Role $role): self
    {
        $this->roles->removeElement($role);

        return $this;
    }


    public function getPassword(): string
    {
        // Assuming you have a password property
        return $this->heslo;
    }

    public function setPassword(string $password): self {
        $this->heslo = $password;
        return $this;
    }

    public function getSalt(): ?string
    {
        // If you are using bcrypt or argon2i, the salt is not needed
        return null;
    }

    public function getUserIdentifier(): string
    {
        // Use the property that represents the username in your entity
        return $this->email; // or username if it's a username
    }

    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }
}




