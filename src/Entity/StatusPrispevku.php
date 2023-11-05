<?php

namespace App\Entity;

use App\Repository\StatusPrispevkuRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StatusPrispevkuRepository::class)]
class StatusPrispevku
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'statusPrispevkus')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Prispevek $Prispevek = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $Datum_zmeny = null;

    #[ORM\ManyToOne(inversedBy: 'Status_Prispevku')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Status $status = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrispevek(): ?Prispevek
    {
        return $this->Prispevek;
    }

    public function setPrispevek(?Prispevek $Prispevek): static
    {
        $this->Prispevek = $Prispevek;

        return $this;
    }

    public function getDatumZmeny(): ?\DateTimeInterface
    {
        return $this->Datum_zmeny;
    }

    public function setDatumZmeny(\DateTimeInterface $Datum_zmeny): static
    {
        $this->Datum_zmeny = $Datum_zmeny;

        return $this;
    }

    public function getStatus(): ?Status
    {
        return $this->status;
    }

    public function setStatus(?Status $status): static
    {
        $this->status = $status;

        return $this;
    }
}
