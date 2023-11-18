<?php

namespace App\Entity;

use App\Repository\RoleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RoleRepository::class)]
class Role
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $jmeno_role = null;

    #[ORM\ManyToMany(targetEntity: Osoba::class, mappedBy: 'roles')]
    private Collection $osobas;

    #[ORM\OneToMany(targetEntity: Status::class, mappedBy: 'ZodpovednaRole')]
    private $statuses;

    public function __construct()
    {
        $this->osobas = new ArrayCollection();
        $this->statuses = new ArrayCollection();
    }

    public function getStatuses(): Collection
    {
        return $this->statuses;
    }

    public function addStatus(Status $status): static
    {
        if (!$this->statuses->contains($status)) {
            $this->statuses->add($status);
            $status->setZodpovednaRole($this);
        }

        return $this;
    }

    public function removeStatus(Status $status): static
    {
        if ($this->statuses->removeElement($status)) {
            $status->setZodpovednaRole(null);
        }

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getJmenoRole(): ?string
    {
        return $this->jmeno_role;
    }

    public function setJmenoRole(string $jmeno_role): static
    {
        $this->jmeno_role = $jmeno_role;

        return $this;
    }

    /**
     * @return Collection<int, Osoba>
     */
    public function getOsobas(): Collection
    {
        return $this->osobas;
    }

    public function addOsoba(Osoba $osoba): static
    {
        if (!$this->osobas->contains($osoba)) {
            $this->osobas->add($osoba);
            $osoba->addRole($this);
        }

        return $this;
    }

    public function removeOsoba(Osoba $osoba): static
    {
        if ($this->osobas->removeElement($osoba)) {
            $osoba->removeRole($this);
        }

        return $this;
    }

    public function __toString()
    {
        return $this->getJmenoRole(); 
    }
}
