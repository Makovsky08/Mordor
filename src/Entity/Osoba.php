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

    #[ORM\OneToMany(mappedBy: 'Autor', targetEntity: Prispevek::class, orphanRemoval: true)]
    private Collection $prispeveks;

    #[ORM\OneToMany(mappedBy: 'Odkoho', targetEntity: Reakce::class)]
    private Collection $reakcesOdkoho;

    #[ORM\OneToMany(mappedBy: 'Komu', targetEntity: Reakce::class)]
    private Collection $reakcesKomu;

    #[ORM\OneToMany(mappedBy: 'Recenzent', targetEntity: PozadavekNaRecenciPrispevku::class)]
    private Collection $pozadavekNaRecenciPrispevkusRecenzent;

    #[ORM\OneToMany(mappedBy: 'Redaktor', targetEntity: PozadavekNaRecenciPrispevku::class)]
    private Collection $pozadavekNaRecenciPrispevkusRedaktor;



    public function __construct()
    {
        $this->roles = new ArrayCollection();
        $this->prispeveks = new ArrayCollection();
        $this->reakcesOdkoho = new ArrayCollection();
        $this->reakcesKomu = new ArrayCollection();
        $this->pozadavekNaRecenciPrispevkusRecenzent = new ArrayCollection();
        $this->pozadavekNaRecenciPrispevkusRedaktor = new ArrayCollection();
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

    /**
     * @return Collection<int, Prispevek>
     */
    public function getPrispeveks(): Collection
    {
        return $this->prispeveks;
    }

    public function addPrispevek(Prispevek $prispevek): static
    {
        if (!$this->prispeveks->contains($prispevek)) {
            $this->prispeveks->add($prispevek);
            $prispevek->setAutor($this);
        }

        return $this;
    }

    public function removePrispevek(Prispevek $prispevek): static
    {
        if ($this->prispeveks->removeElement($prispevek)) {
            // set the owning side to null (unless already changed)
            if ($prispevek->getAutor() === $this) {
                $prispevek->setAutor(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Reakce>
     */
    public function getreakcesOdkoho(): Collection
    {
        return $this->reakcesOdkoho;
    }

    public function addReakceOdkoho(Reakce $reakce): static
    {
        if (!$this->reakcesOdkoho->contains($reakce)) {
            $this->reakcesOdkoho->add($reakce);
            $reakce->setOdkoho($this);
        }

        return $this;
    }

    public function removeReakceOdkoho(Reakce $reakce): static
    {
        if ($this->reakcesOdkoho->removeElement($reakce)) {
            // set the owning side to null (unless already changed)
            if ($reakce->getOdkoho() === $this) {
                $reakce->setOdkoho(null);
            }
        }

        return $this;
    }


    /**
     * @return Collection<int, Reakce>
     */
    public function getreakcesKomu(): Collection
    {
        return $this->reakcesKomu;
    }

    public function addReakceKomu(Reakce $reakce): static
    {
        if (!$this->reakcesKomu->contains($reakce)) {
            $this->reakcesKomu->add($reakce);
            $reakce->setOdkoho($this);
        }

        return $this;
    }

    public function removeReakceKomu(Reakce $reakce): static
    {
        if ($this->reakcesKomu->removeElement($reakce)) {
            // set the owning side to null (unless already changed)
            if ($reakce->getKomu() === $this) {
                $reakce->setKomu(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, PozadavekNaRecenciPrispevku>
     */
    public function getpozadavekNaRecenciPrispevkusRecenzent(): Collection
    {
        return $this->pozadavekNaRecenciPrispevkusRecenzent;
    }

    public function addPozadavekNaRecenciPrispevkuRecenzent(PozadavekNaRecenciPrispevku $pozadavekNaRecenciPrispevku): static
    {
        if (!$this->pozadavekNaRecenciPrispevkusRecenzent->contains($pozadavekNaRecenciPrispevku)) {
            $this->pozadavekNaRecenciPrispevkusRecenzent->add($pozadavekNaRecenciPrispevku);
            $pozadavekNaRecenciPrispevku->setRecenzent($this);
        }

        return $this;
    }

    public function removePozadavekNaRecenciPrispevkuRecenzent(PozadavekNaRecenciPrispevku $pozadavekNaRecenciPrispevku): static
    {
        if ($this->pozadavekNaRecenciPrispevkusRecenzent->removeElement($pozadavekNaRecenciPrispevku)) {
            // set the owning side to null (unless already changed)
            if ($pozadavekNaRecenciPrispevku->getRecenzent() === $this) {
                $pozadavekNaRecenciPrispevku->setRecenzent(null);
            }
        }

        return $this;
    }


        /**
     * @return Collection<int, PozadavekNaRecenciPrispevku>
     */
    public function getpozadavekNaRecenciPrispevkusRedaktor(): Collection
    {
        return $this->pozadavekNaRecenciPrispevkusRedaktor;
    }

    public function addPozadavekNaRecenciPrispevkuRedaktor(PozadavekNaRecenciPrispevku $pozadavekNaRecenciPrispevku): static
    {
        if (!$this->pozadavekNaRecenciPrispevkusRedaktor->contains($pozadavekNaRecenciPrispevku)) {
            $this->pozadavekNaRecenciPrispevkusRedaktor->add($pozadavekNaRecenciPrispevku);
            $pozadavekNaRecenciPrispevku->setRedaktor($this);
        }

        return $this;
    }

    public function removePozadavekNaRecenciPrispevkuRedaktor(PozadavekNaRecenciPrispevku $pozadavekNaRecenciPrispevku): static
    {
        if ($this->pozadavekNaRecenciPrispevkusRedaktor->removeElement($pozadavekNaRecenciPrispevku)) {
            // set the owning side to null (unless already changed)
            if ($pozadavekNaRecenciPrispevku->getRedaktor() === $this) {
                $pozadavekNaRecenciPrispevku->setRedaktor(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->getJmeno() . " " . $this->getPrijmeni();
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




