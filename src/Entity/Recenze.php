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
    private ?string $text = null;

    #[ORM\Column(length: 255)]
    private ?string $datum_recenze = null;

    #[ORM\Column]
    private ?int $aktualnost = null;

    #[ORM\Column]
    private ?int $originalita = null;

    #[ORM\Column]
    private ?int $odborna_uroven = null;

    #[ORM\Column]
    private ?int $jazykova_stylisticka_uroven = null;

    #[ORM\OneToMany(mappedBy: 'recenze', targetEntity: Reakce::class)]
    private Collection $reakce;

    public function __construct()
    {
        $this->reakce = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(string $Text): static
    {
        $this->text = $Text;

        return $this;
    }

    public function getDatumRecenze(): ?string
    {
        return $this->datum_recenze;
    }

    public function setDatumRecenze(string $datum_recenze): static
    {
        $this->datum_recenze = $datum_recenze;

        return $this;
    }

    public function getAktualnost(): ?int
    {
        return $this->aktualnost;
    }

    public function setAktualnost(int $aktualnost): static
    {
        $this->aktualnost = $aktualnost;

        return $this;
    }

    public function getOriginalita(): ?int
    {
        return $this->originalita;
    }

    public function setOriginalita(int $originalita): static
    {
        $this->originalita = $originalita;

        return $this;
    }

    public function getOdbornaUroven(): ?int
    {
        return $this->odborna_uroven;
    }

    public function setOdbornaUroven(int $odborna_uroven): static
    {
        $this->odborna_uroven = $odborna_uroven;

        return $this;
    }

    public function getJazykovaStylistickaUroven(): ?int
    {
        return $this->jazykova_stylisticka_uroven;
    }

    public function setJazykovaStylistickaUroven(int $jazykova_stylisticka_uroven): static
    {
        $this->jazykova_stylisticka_uroven = $jazykova_stylisticka_uroven;

        return $this;
    }

    /**
     * @return Collection<int, Reakce>
     */
    public function getReakce(): Collection
    {
        return $this->reakce;
    }

    public function addReakce(Reakce $reakce): static
    {
        if (!$this->reakce->contains($reakce)) {
            $this->reakce->add($reakce);
            $reakce->setRecenze($this);
        }

        return $this;
    }

    public function removeReakce(Reakce $reakce): static
    {
        if ($this->reakce->removeElement($reakce)) {
            // set the owning side to null (unless already changed)
            if ($reakce->getRecenze() === $this) {
                $reakce->setRecenze(null);
            }
        }

        return $this;
    }
}
