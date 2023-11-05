<?php

namespace App\Entity;

use App\Repository\PrispevekRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PrispevekRepository::class)]
class Prispevek
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'prispeveks')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Osoba $Autor = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $Datum_vytvoreni = null;

    #[ORM\Column(length: 255)]
    private ?string $Tematika = null;

    #[ORM\OneToMany(mappedBy: 'Prispevek', targetEntity: VerzePrispevku::class, orphanRemoval: true)]
    private Collection $verzePrispevkus;

    #[ORM\ManyToMany(targetEntity: Vydani::class, mappedBy: 'Prispevek')]
    private Collection $vydanis;

    #[ORM\OneToMany(mappedBy: 'Prispevek', targetEntity: StatusPrispevku::class, orphanRemoval: true)]
    private Collection $statusPrispevkus;

    #[ORM\OneToMany(mappedBy: 'Odkazovany_prispevek', targetEntity: Reakce::class)]
    private Collection $reakces;

    #[ORM\OneToMany(mappedBy: 'Prispevek', targetEntity: PozadavekNaRecenciPrispevku::class)]
    private Collection $pozadavekNaRecenciPrispevkus;

    public function __construct()
    {
        $this->verzePrispevkus = new ArrayCollection();
        $this->vydanis = new ArrayCollection();
        $this->statusPrispevkus = new ArrayCollection();
        $this->reakces = new ArrayCollection();
        $this->pozadavekNaRecenciPrispevkus = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAutor(): ?Osoba
    {
        return $this->Autor;
    }

    public function setAutor(?Osoba $Autor): static
    {
        $this->Autor = $Autor;

        return $this;
    }

    public function getDatumVytvoreni(): ?\DateTimeInterface
    {
        return $this->Datum_vytvoreni;
    }

    public function setDatumVytvoreni(\DateTimeInterface $Datum_vytvoreni): static
    {
        $this->Datum_vytvoreni = $Datum_vytvoreni;

        return $this;
    }

    public function getTematika(): ?string
    {
        return $this->Tematika;
    }

    public function setTematika(string $Tematika): static
    {
        $this->Tematika = $Tematika;

        return $this;
    }

    /**
     * @return Collection<int, VerzePrispevku>
     */
    public function getVerzePrispevkus(): Collection
    {
        return $this->verzePrispevkus;
    }

    public function addVerzePrispevku(VerzePrispevku $verzePrispevku): static
    {
        if (!$this->verzePrispevkus->contains($verzePrispevku)) {
            $this->verzePrispevkus->add($verzePrispevku);
            $verzePrispevku->setPrispevek($this);
        }

        return $this;
    }

    public function removeVerzePrispevku(VerzePrispevku $verzePrispevku): static
    {
        if ($this->verzePrispevkus->removeElement($verzePrispevku)) {
            // set the owning side to null (unless already changed)
            if ($verzePrispevku->getPrispevek() === $this) {
                $verzePrispevku->setPrispevek(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Vydani>
     */
    public function getVydanis(): Collection
    {
        return $this->vydanis;
    }

    public function addVydani(Vydani $vydani): static
    {
        if (!$this->vydanis->contains($vydani)) {
            $this->vydanis->add($vydani);
            $vydani->addPrispevek($this);
        }

        return $this;
    }

    public function removeVydani(Vydani $vydani): static
    {
        if ($this->vydanis->removeElement($vydani)) {
            $vydani->removePrispevek($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, StatusPrispevku>
     */
    public function getStatusPrispevkus(): Collection
    {
        return $this->statusPrispevkus;
    }

    public function addStatusPrispevku(StatusPrispevku $statusPrispevku): static
    {
        if (!$this->statusPrispevkus->contains($statusPrispevku)) {
            $this->statusPrispevkus->add($statusPrispevku);
            $statusPrispevku->setPrispevek($this);
        }

        return $this;
    }

    public function removeStatusPrispevku(StatusPrispevku $statusPrispevku): static
    {
        if ($this->statusPrispevkus->removeElement($statusPrispevku)) {
            // set the owning side to null (unless already changed)
            if ($statusPrispevku->getPrispevek() === $this) {
                $statusPrispevku->setPrispevek(null);
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
            $reakce->setOdkazovanyPrispevek($this);
        }

        return $this;
    }

    public function removeReakce(Reakce $reakce): static
    {
        if ($this->reakces->removeElement($reakce)) {
            // set the owning side to null (unless already changed)
            if ($reakce->getOdkazovanyPrispevek() === $this) {
                $reakce->setOdkazovanyPrispevek(null);
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
            $pozadavekNaRecenciPrispevku->setPrispevek($this);
        }

        return $this;
    }

    public function removePozadavekNaRecenciPrispevku(PozadavekNaRecenciPrispevku $pozadavekNaRecenciPrispevku): static
    {
        if ($this->pozadavekNaRecenciPrispevkus->removeElement($pozadavekNaRecenciPrispevku)) {
            // set the owning side to null (unless already changed)
            if ($pozadavekNaRecenciPrispevku->getPrispevek() === $this) {
                $pozadavekNaRecenciPrispevku->setPrispevek(null);
            }
        }

        return $this;
    }
}
