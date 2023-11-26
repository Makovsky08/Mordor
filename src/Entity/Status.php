<?php
declare(strict_types=1);

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
    private ?string $title = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\ManyToOne(targetEntity: Role::class, inversedBy: 'roles')]
    #[ORM\JoinColumn(nullable:false)]
    private ?Role $responsible_role = null;

    #[ORM\OneToMany(mappedBy: 'status', targetEntity: StatusPost::class)]
    private Collection $status_post;

    public function __construct()
    {
        $this->status_post = new ArrayCollection();
    }

    public function getResponsibleRole(): ?Role
    {
        return $this->responsible_role;
    }

    public function setResponsibleRole(?Role $responsibleRole): self
    {
        $this->responsible_role = $responsibleRole;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, StatusPost>
     */
    public function getStatusPost(): Collection
    {
        return $this->status_post;
    }

    public function addStatusPost(StatusPost $statusPost): static
    {
        if (!$this->status_post->contains($statusPost)) {
            $this->status_post->add($statusPost);
            $statusPost->setStatus($this);
        }

        return $this;
    }

    public function removeStatusPost(StatusPost $statusPost): static
    {
        if ($this->status_post->removeElement($statusPost)) {
            // set the owning side to null (unless already changed)
            if ($statusPost->getStatus() === $this) {
                $statusPost->setStatus(null);
            }
        }

        return $this;
    }
}
