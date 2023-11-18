<?php

namespace App\Entity;

use App\Repository\StatusRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StatusRepository::class)]
class Status
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Nazev = null;

    #[ORM\Column(length: 255)]
    private ?string $Popis = null;

    #[ORM\ManyToOne(targetEntity: Role::class, inversedBy: 'roles')]
    #[ORM\JoinColumn(nullable:false)]
    private ?Role $Zodpovedna_role = null;

    #[ORM\OneToMany(mappedBy: 'status', targetEntity: StatusPrispevku::class)]
    private Collection $Status_Prispevku;

    public function __construct()
    {
        $this->Status_Prispevku = new ArrayCollection();
    }

    public function getZodpovedna_role(): ?Role
    {
        return $this->Zodpovedna_role;
    }

    public function setZodpovedna_role(?Role $Zodpovedna_role): self
    {
        $this->Zodpovedna_role = $Zodpovedna_role;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNazev(): ?string
    {
        return $this->Nazev;
    }

    public function setNazev(string $Nazev): static
    {
        $this->Nazev = $Nazev;

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

    public function getZodpovednaRole(): ?Role
    {
        return $this->Zodpovedna_role;
    }

    public function setZodpovednaRole(?Role $Zodpovedna_role): static
    {
        $this->Zodpovedna_role = $Zodpovedna_role;

        return $this;
    }

    /**
     * @return Collection<int, StatusPrispevku>
     */
    public function getStatusPrispevku(): Collection
    {
        return $this->Status_Prispevku;
    }

    public function addStatusPrispevku(StatusPrispevku $statusPrispevku): static
    {
        if (!$this->Status_Prispevku->contains($statusPrispevku)) {
            $this->Status_Prispevku->add($statusPrispevku);
            $statusPrispevku->setStatus($this);
        }

        return $this;
    }

    public function removeStatusPrispevku(StatusPrispevku $statusPrispevku): static
    {
        if ($this->Status_Prispevku->removeElement($statusPrispevku)) {
            // set the owning side to null (unless already changed)
            if ($statusPrispevku->getStatus() === $this) {
                $statusPrispevku->setStatus(null);
            }
        }

        return $this;
    }
}
