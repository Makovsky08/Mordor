<?php

namespace App\Entity;

use App\Repository\ReakceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReakceRepository::class)]
class Reakce
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Typ = null;

    #[ORM\ManyToOne(inversedBy: 'reakces')]
    private ?Osoba $Odkoho = null;

    #[ORM\ManyToOne(inversedBy: 'reakces')]
    private ?Osoba $Komu = null;

    #[ORM\Column(length: 255)]
    private ?string $Text = null;

    #[ORM\ManyToOne(inversedBy: 'reakces')]
    private ?Prispevek $Odkazovany_prispevek = null;

    #[ORM\ManyToOne(targetEntity: self::class, inversedBy: 'reakces')]
    private ?self $Odpoved_na = null;

    #[ORM\OneToMany(mappedBy: 'Odpoved_na', targetEntity: self::class)]
    private Collection $reakces;

    #[ORM\ManyToOne(inversedBy: 'Reakce')]
    private ?Recenze $recenze = null;

    public function __construct()
    {
        $this->reakces = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTyp(): ?string
    {
        return $this->Typ;
    }

    public function setTyp(string $Typ): static
    {
        $this->Typ = $Typ;

        return $this;
    }

    public function getOdkoho(): ?Osoba
    {
        return $this->Odkoho;
    }

    public function setOdkoho(?Osoba $Odkoho): static
    {
        $this->Odkoho = $Odkoho;

        return $this;
    }

    public function getKomu(): ?Osoba
    {
        return $this->Komu;
    }

    public function setKomu(?Osoba $Komu): static
    {
        $this->Komu = $Komu;

        return $this;
    }

    public function getText(): ?string
    {
        return $this->Text;
    }

    public function setText(string $Text): static
    {
        $this->Text = $Text;

        return $this;
    }

    public function getOdkazovanyPrispevek(): ?Prispevek
    {
        return $this->Odkazovany_prispevek;
    }

    public function setOdkazovanyPrispevek(?Prispevek $Odkazovany_prispevek): static
    {
        $this->Odkazovany_prispevek = $Odkazovany_prispevek;

        return $this;
    }

    public function getOdpovedNa(): ?self
    {
        return $this->Odpoved_na;
    }

    public function setOdpovedNa(?self $Odpoved_na): static
    {
        $this->Odpoved_na = $Odpoved_na;

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getReakces(): Collection
    {
        return $this->reakces;
    }

    public function addReakce(self $reakce): static
    {
        if (!$this->reakces->contains($reakce)) {
            $this->reakces->add($reakce);
            $reakce->setOdpovedNa($this);
        }

        return $this;
    }

    public function removeReakce(self $reakce): static
    {
        if ($this->reakces->removeElement($reakce)) {
            // set the owning side to null (unless already changed)
            if ($reakce->getOdpovedNa() === $this) {
                $reakce->setOdpovedNa(null);
            }
        }

        return $this;
    }

    public function getRecenze(): ?Recenze
    {
        return $this->recenze;
    }

    public function setRecenze(?Recenze $recenze): static
    {
        $this->recenze = $recenze;

        return $this;
    }
}
