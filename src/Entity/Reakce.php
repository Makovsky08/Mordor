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

    #[ORM\ManyToOne(inversedBy: 'reakcesOdkoho')]
    private ?User $Odkoho = null;

    #[ORM\ManyToOne(inversedBy: 'reakcesKomu')]
    private ?User $Komu = null;

    #[ORM\Column(length: 255)]
    private ?string $Text = null;

    #[ORM\ManyToOne(inversedBy: 'reakces')]
    private ?Post $Odkazovany_prispevek = null;

    #[ORM\ManyToOne(targetEntity: self::class, inversedBy: 'reakces')]
    private ?self $Odpoved_na = null;

    #[ORM\ManyToMany(targetEntity: StatusPrispevku::class, mappedBy: 'reakces')]
    private Collection $statusPrispevkus;

    #[ORM\OneToMany(mappedBy: 'Odpoved_na', targetEntity: self::class)]
    private Collection $reakces;

    #[ORM\ManyToOne(inversedBy: 'Reakce')]
    private ?Review $recenze = null;

    public function __construct()
    {
        $this->reakces = new ArrayCollection();
        $this->statusPrispevkus = new ArrayCollection();
    }

    public function getStatusPrispevkus(): Collection
    {
        return $this->statusPrispevkus;
    }

    public function addStatusPrispevku(StatusPrispevku $statusPrispevku): static
    {
        if (!$this->statusPrispevkus->contains($statusPrispevku)) {
            $this->statusPrispevkus->add($statusPrispevku);
            $statusPrispevku->addReakce($this);
        }

        return $this;
    }

    public function removeStatusPrispevku(StatusPrispevku $statusPrispevku): static
    {
        if ($this->statusPrispevkus->removeElement($statusPrispevku)) {
            $statusPrispevku->removeReakce($this);
        }

        return $this;
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

    public function getOdkoho(): ?User
    {
        return $this->Odkoho;
    }

    public function setOdkoho(?User $Odkoho): static
    {
        $this->Odkoho = $Odkoho;

        return $this;
    }

    public function getKomu(): ?User
    {
        return $this->Komu;
    }

    public function setKomu(?User $Komu): static
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

    public function getOdkazovanyPrispevek(): ?Post
    {
        return $this->Odkazovany_prispevek;
    }

    public function setOdkazovanyPrispevek(?Post $Odkazovany_prispevek): static
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

    public function getRecenze(): ?Review
    {
        return $this->recenze;
    }

    public function setRecenze(?Review $recenze): static
    {
        $this->recenze = $recenze;

        return $this;
    }
}
