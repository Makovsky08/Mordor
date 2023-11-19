<?php
declare(strict_types=1);

namespace App\Entity;

use App\Repository\PostRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PostRepository::class)]
class Post
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'posts')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $author = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $created_at = null;

    #[ORM\Column(length: 255)]
    private ?string $topics = null;

    #[ORM\OneToMany(mappedBy: 'post', targetEntity: VerzePrispevku::class, orphanRemoval: true)]
    private Collection $verzePrispevkus;

    #[ORM\ManyToMany(targetEntity: Release::class, mappedBy: 'post')]
    private Collection $release;

    #[ORM\OneToMany(mappedBy: 'post', targetEntity: StatusPrispevku::class, orphanRemoval: true)]
    private Collection $statusPrispevkus;

    #[ORM\OneToMany(mappedBy: 'Odkazovany_prispevek', targetEntity: Reakce::class)]
    private Collection $reakces;

    #[ORM\OneToMany(mappedBy: 'post', targetEntity: PozadavekNaRecenciPrispevku::class)]
    private Collection $pozadavekNaRecenciPrispevkus;

    public function __construct()
    {
        $this->verzePrispevkus = new ArrayCollection();
        $this->release = new ArrayCollection();
        $this->statusPrispevkus = new ArrayCollection();
        $this->reakces = new ArrayCollection();
        $this->pozadavekNaRecenciPrispevkus = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAuthor(): ?User
    {
        return $this->author;
    }

    public function setAuthor(?User $author): static
    {
        $this->author = $author;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): static
    {
        $this->created_at = $createdAt;

        return $this;
    }

    public function getTopics(): ?string
    {
        return $this->topics;
    }

    public function setTopics(string $Topics): static
    {
        $this->topics = $Topics;

        return $this;
    }

    /**
     * @return Collection<int, VerzePrispevku>
     */
    public function getVerzePrispevkus(): Collection
    {
        return $this->verzePrispevkus;
    }

    public function addVerzePrispevku(VerzePrispevku $verzePrispevku): static
    {
        if (!$this->verzePrispevkus->contains($verzePrispevku)) {
            $this->verzePrispevkus->add($verzePrispevku);
            $verzePrispevku->setPrispevek($this);
        }

        return $this;
    }

    public function removeVerzePrispevku(VerzePrispevku $verzePrispevku): static
    {
        if ($this->verzePrispevkus->removeElement($verzePrispevku)) {
            // set the owning side to null (unless already changed)
            if ($verzePrispevku->getPrispevek() === $this) {
                $verzePrispevku->setPrispevek(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Release>
     */
    public function getRelease(): Collection
    {
        return $this->release;
    }

    public function addRelease(Release $release): static
    {
        if (!$this->release->contains($release)) {
            $this->release->add($release);
            $release->addPost($this);
        }

        return $this;
    }

    public function removeRelease(Release $release): static
    {
        if ($this->release->removeElement($release)) {
            $release->removePost($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, StatusPrispevku>
     */
    public function getStatusPrispevkus(): Collection
    {
        return $this->statusPrispevkus;
    }

    public function addStatusPrispevku(StatusPrispevku $statusPrispevku): static
    {
        if (!$this->statusPrispevkus->contains($statusPrispevku)) {
            $this->statusPrispevkus->add($statusPrispevku);
            $statusPrispevku->setPrispevek($this);
        }

        return $this;
    }

    public function removeStatusPrispevku(StatusPrispevku $statusPrispevku): static
    {
        if ($this->statusPrispevkus->removeElement($statusPrispevku)) {
            // set the owning side to null (unless already changed)
            if ($statusPrispevku->getPrispevek() === $this) {
                $statusPrispevku->setPrispevek(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Reakce>
     */
    public function getReakces(): Collection
    {
        return $this->reakces;
    }

    public function addReakce(Reakce $reakce): static
    {
        if (!$this->reakces->contains($reakce)) {
            $this->reakces->add($reakce);
            $reakce->setOdkazovanyPrispevek($this);
        }

        return $this;
    }

    public function removeReakce(Reakce $reakce): static
    {
        if ($this->reakces->removeElement($reakce)) {
            // set the owning side to null (unless already changed)
            if ($reakce->getOdkazovanyPrispevek() === $this) {
                $reakce->setOdkazovanyPrispevek(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, PozadavekNaRecenciPrispevku>
     */
    public function getPozadavekNaRecenciPrispevkus(): Collection
    {
        return $this->pozadavekNaRecenciPrispevkus;
    }

    public function addPozadavekNaRecenciPrispevku(PozadavekNaRecenciPrispevku $pozadavekNaRecenciPrispevku): static
    {
        if (!$this->pozadavekNaRecenciPrispevkus->contains($pozadavekNaRecenciPrispevku)) {
            $this->pozadavekNaRecenciPrispevkus->add($pozadavekNaRecenciPrispevku);
            $pozadavekNaRecenciPrispevku->setPrispevek($this);
        }

        return $this;
    }

    public function removePozadavekNaRecenciPrispevku(PozadavekNaRecenciPrispevku $pozadavekNaRecenciPrispevku): static
    {
        if ($this->pozadavekNaRecenciPrispevkus->removeElement($pozadavekNaRecenciPrispevku)) {
            // set the owning side to null (unless already changed)
            if ($pozadavekNaRecenciPrispevku->getPrispevek() === $this) {
                $pozadavekNaRecenciPrispevku->setPrispevek(null);
            }
        }

        return $this;
    }
}
