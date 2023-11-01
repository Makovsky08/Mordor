<?php

namespace App\Entity;

use App\Repository\RecenzeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RecenzeRepository::class)]
class Recenze
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Text = null;

    #[ORM\Column(length: 255)]
    private ?string $Datum_recenze = null;

    #[ORM\Column]
    private ?int $Aktualnost = null;

    #[ORM\Column]
    private ?int $Originalita = null;

    #[ORM\Column]
    private ?int $Odborna_Uroven = null;

    #[ORM\Column]
    private ?int $Jazykova_stylisticka_uroven = null;

    #[ORM\OneToMany(mappedBy: 'recenze', targetEntity: Reakce::class)]
    private Collection $Reakce;

    public function __construct()
    {
        $this->Reakce = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getDatumRecenze(): ?string
    {
        return $this->Datum_recenze;
    }

    public function setDatumRecenze(string $Datum_recenze): static
    {
        $this->Datum_recenze = $Datum_recenze;

        return $this;
    }

    public function getAktualnost(): ?int
    {
        return $this->Aktualnost;
    }

    public function setAktualnost(int $Aktualnost): static
    {
        $this->Aktualnost = $Aktualnost;

        return $this;
    }

    public function getOriginalita(): ?int
    {
        return $this->Originalita;
    }

    public function setOriginalita(int $Originalita): static
    {
        $this->Originalita = $Originalita;

        return $this;
    }

    public function getOdbornaUroven(): ?int
    {
        return $this->Odborna_Uroven;
    }

    public function setOdbornaUroven(int $Odborna_Uroven): static
    {
        $this->Odborna_Uroven = $Odborna_Uroven;

        return $this;
    }

    public function getJazykovaStylistickaUroven(): ?int
    {
        return $this->Jazykova_stylisticka_uroven;
    }

    public function setJazykovaStylistickaUroven(int $Jazykova_stylisticka_uroven): static
    {
        $this->Jazykova_stylisticka_uroven = $Jazykova_stylisticka_uroven;

        return $this;
    }

    /**
     * @return Collection<int, Reakce>
     */
    public function getReakce(): Collection
    {
        return $this->Reakce;
    }

    public function addReakce(Reakce $reakce): static
    {
        if (!$this->Reakce->contains($reakce)) {
            $this->Reakce->add($reakce);
            $reakce->setRecenze($this);
        }

        return $this;
    }

    public function removeReakce(Reakce $reakce): static
    {
        if ($this->Reakce->removeElement($reakce)) {
            // set the owning side to null (unless already changed)
            if ($reakce->getRecenze() === $this) {
                $reakce->setRecenze(null);
            }
        }

        return $this;
    }
}
