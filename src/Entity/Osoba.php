<?php

namespace App\Entity;

use App\Repository\OsobaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

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
    private Collection $roles;

    #[ORM\OneToMany(mappedBy: 'Autor', targetEntity: Prispevek::class, orphanRemoval: true)]
    private Collection $prispeveks;

    #[ORM\OneToMany(mappedBy: 'Odkoho', targetEntity: Reakce::class)]
    private Collection $reakces;

    #[ORM\OneToMany(mappedBy: 'Recenzent', targetEntity: PozadavekNaRecenciPrispevku::class)]
    private Collection $pozadavekNaRecenciPrispevkus;

    public function __construct()
    {
        $this->roles = new ArrayCollection();
        $this->prispeveks = new ArrayCollection();
        $this->reakces = new ArrayCollection();
        $this->pozadavekNaRecenciPrispevkus = new ArrayCollection();
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
     * @return Collection<int, Role>
     */
    public function getRoles(): Collection
    {
        return $this->roles;
    }

    public function addRole(Role $role): static
    {
        if (!$this->roles->contains($role)) {
            $this->roles->add($role);
        }

        return $this;
    }

    public function removeRole(Role $role): static
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
    public function getReakces(): Collection
    {
        return $this->reakces;
    }

    public function addReakce(Reakce $reakce): static
    {
        if (!$this->reakces->contains($reakce)) {
            $this->reakces->add($reakce);
            $reakce->setOdkoho($this);
        }

        return $this;
    }

    public function removeReakce(Reakce $reakce): static
    {
        if ($this->reakces->removeElement($reakce)) {
            // set the owning side to null (unless already changed)
            if ($reakce->getOdkoho() === $this) {
                $reakce->setOdkoho(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, PozadavekNaRecenciPrispevku>
     */
    public function getPozadavekNaRecenciPrispevkus(): Collection
    {
        return $this->pozadavekNaRecenciPrispevkus;
    }

    public function addPozadavekNaRecenciPrispevku(PozadavekNaRecenciPrispevku $pozadavekNaRecenciPrispevku): static
    {
        if (!$this->pozadavekNaRecenciPrispevkus->contains($pozadavekNaRecenciPrispevku)) {
            $this->pozadavekNaRecenciPrispevkus->add($pozadavekNaRecenciPrispevku);
            $pozadavekNaRecenciPrispevku->setRecenzent($this);
        }

        return $this;
    }

    public function removePozadavekNaRecenciPrispevku(PozadavekNaRecenciPrispevku $pozadavekNaRecenciPrispevku): static
    {
        if ($this->pozadavekNaRecenciPrispevkus->removeElement($pozadavekNaRecenciPrispevku)) {
            // set the owning side to null (unless already changed)
            if ($pozadavekNaRecenciPrispevku->getRecenzent() === $this) {
                $pozadavekNaRecenciPrispevku->setRecenzent(null);
            }
        }

        return $this;
    }
}
