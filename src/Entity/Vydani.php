<?php

namespace App\Entity;

use App\Repository\VydaniRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VydaniRepository::class)]
class Vydani
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Jmeno = null;

    #[ORM\Column(length: 255)]
    private ?string $Popis = null;

    #[ORM\Column(length: 255)]
    private ?string $FilePath = null;

    #[ORM\Column(length: 255)]
    private ?string $Tematika = null;

    #[ORM\Column]
    private ?int $Kapacita = null;

    #[ORM\Column]
    private ?int $Cislo = null;

    #[ORM\ManyToMany(targetEntity: Prispevek::class, inversedBy: 'vydanis')]
    private Collection $Prispevek;

    public function __construct()
    {
        $this->Prispevek = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getJmeno(): ?string
    {
        return $this->Jmeno;
    }

    public function setJmeno(string $Jmeno): static
    {
        $this->Jmeno = $Jmeno;

        return $this;
    }

    public function getPopis(): ?string
    {
        return $this->Popis;
    }

    public function setPopis(string $Popis): static
    {
        $this->Popis = $Popis;

        return $this;
    }

    public function getFilePath(): ?string
    {
        return $this->FilePath;
    }

    public function setFilePath(string $FilePath): static
    {
        $this->FilePath = $FilePath;

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

    public function getKapacita(): ?int
    {
        return $this->Kapacita;
    }

    public function setKapacita(int $Kapacita): static
    {
        $this->Kapacita = $Kapacita;

        return $this;
    }

    public function getCislo(): ?int
    {
        return $this->Cislo;
    }

    public function setCislo(int $Cislo): static
    {
        $this->Cislo = $Cislo;

        return $this;
    }

    /**
     * @return Collection<int, Prispevek>
     */
    public function getPrispevek(): Collection
    {
        return $this->Prispevek;
    }

    public function addPrispevek(Prispevek $prispevek): static
    {
        if (!$this->Prispevek->contains($prispevek)) {
            $this->Prispevek->add($prispevek);
        }

        return $this;
    }

    public function removePrispevek(Prispevek $prispevek): static
    {
        $this->Prispevek->removeElement($prispevek);

        return $this;
    }

    public function __toString()
    {
        // This will return the Jmeno property when the Vydani object is treated as a string.
        return $this->getJmeno();
    }
}
