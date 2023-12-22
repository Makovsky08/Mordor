<?php
declare(strict_types=1);

namespace App\Entity;

use App\Repository\StatusPostRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StatusPostRepository::class)]
class StatusPost
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'statusPosts')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Post $post = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $updated_at = null;

    #[ORM\ManyToOne(inversedBy: 'Status_Post')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Status $status = null;

    #[ORM\ManyToMany(targetEntity: Response::class, inversedBy: 'statusPosts')]
    private ArrayCollection $responses;

    public function __construct()
    {
        $this->responses = new ArrayCollection();
    }

    public function getResponses(): Collection
    {
        return $this->responses;
    }

    public function addResponse(Response $response): static
    {
        if (!$this->responses->contains($response)) {
            $this->responses->add($response);
            $response->addStatusPost($this);
        }

        return $this;
    }

    public function removeResponse(Response $response): static
    {
        if ($this->responses->contains($response)) {
            $this->responses->removeElement($response);
            $response->removeStatusPost($this);
        }

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPost(): ?Post
    {
        return $this->post;
    }

    public function setPost(?Post $post): static
    {
        $this->post = $post;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTimeInterface $updated_at): static
    {
        $this->updated_at = $updated_at;

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

    public function getStatusTitle(): ?string
    {
        return $this->status->getTitle();
    }

    public function getPostId(): ?string
    {
        return $this->getPost()->getId();
    }

    public function getPostTitle(string $statusTitle): void
    {
        $this->status->setTitle($statusTitle);
    }
}
