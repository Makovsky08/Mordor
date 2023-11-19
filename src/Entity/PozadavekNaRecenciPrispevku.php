<?php

namespace App\Entity;

use App\Repository\PozadavekNaRecenciPrispevkuRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PozadavekNaRecenciPrispevkuRepository::class)]
class PozadavekNaRecenciPrispevku
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'pozadavekNaRecenciPrispevkusRecenzent')]
    private ?User $Recenzent = null;

    #[ORM\ManyToOne(inversedBy: 'pozadavekNaRecenciPrispevkus')]
    private ?Post $post = null;

    #[ORM\ManyToOne(inversedBy: 'pozadavekNaRecenciPrispevkusRedaktor')]
    private ?User $Redaktor = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $Start_recenzniho_rizeni = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $Konec_recenzniho_rizeni = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRecenzent(): ?User
    {
        return $this->Recenzent;
    }

    public function setRecenzent(?User $Recenzent): static
    {
        $this->Recenzent = $Recenzent;

        return $this;
    }

    public function getPrispevek(): ?Post
    {
        return $this->Prispevek;
    }

    public function setPrispevek(?Post $Prispevek): static
    {
        $this->Prispevek = $Prispevek;

        return $this;
    }

    public function getRedaktor(): ?User
    {
        return $this->Redaktor;
    }

    public function setRedaktor(?User $Redaktor): static
    {
        $this->Redaktor = $Redaktor;

        return $this;
    }

    public function getStartRecenznihoRizeni(): ?\DateTimeInterface
    {
        return $this->Start_recenzniho_rizeni;
    }

    public function setStartRecenznihoRizeni(\DateTimeInterface $Start_recenzniho_rizeni): static
    {
        $this->Start_recenzniho_rizeni = $Start_recenzniho_rizeni;

        return $this;
    }

    public function getKonecRecenznihoRizeni(): ?\DateTimeInterface
    {
        return $this->Konec_recenzniho_rizeni;
    }

    public function setKonecRecenznihoRizeni(\DateTimeInterface $Konec_recenzniho_rizeni): static
    {
        $this->Konec_recenzniho_rizeni = $Konec_recenzniho_rizeni;

        return $this;
    }
}
