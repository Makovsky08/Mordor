<?php

namespace App\Entity;

use App\Repository\VerzePrispevkuRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VerzePrispevkuRepository::class)]
class VerzePrispevku
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'verzePrispevkus')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Prispevek $Prispevek = null;

    #[ORM\Column(length: 255)]
    private ?string $FilePath = null;

    #[ORM\Column(length: 255)]
    private ?string $Popis = null;

    #[ORM\Column(length: 255)]
    private ?string $Jmeno = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $Datum_verze = null;

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

    public function getFilePath(): ?string
    {
        return $this->FilePath;
    }

    public function setFilePath(string $FilePath): static
    {
        $this->FilePath = $FilePath;

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

    public function getJmeno(): ?string
    {
        return $this->Jmeno;
    }

    public function setJmeno(string $Jmeno): static
    {
        $this->Jmeno = $Jmeno;

        return $this;
    }

    public function getDatumVerze(): ?\DateTimeInterface
    {
        return $this->Datum_verze;
    }

    public function setDatumVerze(\DateTimeInterface $Datum_verze): static
    {
        $this->Datum_verze = $Datum_verze;

        return $this;
    }
}
