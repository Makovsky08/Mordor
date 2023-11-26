<?php
declare(strict_types=1);

namespace App\Entity;

use App\Repository\ResponseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ResponseRepository::class)]
class Response
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $type = null;

    #[ORM\ManyToOne(inversedBy: 'responsesFrom')]
    private ?User $from = null;

    #[ORM\ManyToOne(inversedBy: 'responsesTo')]
    private ?User $to = null;

    #[ORM\Column(length: 255)]
    private ?string $text = null;

    #[ORM\ManyToOne(inversedBy: 'responses')]
    private ?Post $related_post = null;

    #[ORM\ManyToOne(targetEntity: self::class, inversedBy: 'responses')]
    private ?self $response_on = null;

    #[ORM\ManyToMany(targetEntity: StatusPost::class, mappedBy: 'responses')]
    private Collection $statusPosts;

    #[ORM\OneToMany(mappedBy: 'Response_on', targetEntity: self::class)]
    private Collection $responses;

    #[ORM\ManyToOne(inversedBy: 'Response')]
    private ?Review $review = null;

    public function __construct()
    {
        $this->responses = new ArrayCollection();
        $this->statusPosts = new ArrayCollection();
    }

    public function getStatusPosts(): Collection
    {
        return $this->statusPosts;
    }

    public function addStatusPost(StatusPost $statusPost): static
    {
        if (!$this->statusPosts->contains($statusPost)) {
            $this->statusPosts->add($statusPost);
            $statusPost->addResponse($this);
        }

        return $this;
    }

    public function removeStatusPost(StatusPost $statusPost): static
    {
        if ($this->statusPosts->removeElement($statusPost)) {
            $statusPost->removeResponse($this);
        }

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getFrom(): ?User
    {
        return $this->from;
    }

    public function setFrom(?User $from): static
    {
        $this->from = $from;

        return $this;
    }

    public function getTo(): ?User
    {
        return $this->to;
    }

    public function setTo(?User $to): static
    {
        $this->to = $to;

        return $this;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(string $text): static
    {
        $this->text = $text;

        return $this;
    }

    public function getRelatedPost(): ?Post
    {
        return $this->related_post;
    }

    public function setRelatedPost(?Post $relatedPost): static
    {
        $this->related_post = $relatedPost;

        return $this;
    }

    public function getResponseOn(): ?self
    {
        return $this->response_on;
    }

    public function setResponseOn(?self $responseOn): static
    {
        $this->response_on = $responseOn;

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getResponses(): Collection
    {
        return $this->responses;
    }

    public function addResponse(self $response): static
    {
        if (!$this->responses->contains($response)) {
            $this->responses->add($response);
            $response->setResponseon($this);
        }

        return $this;
    }

    public function removeResponse(self $response): static
    {
        if ($this->responses->removeElement($response)) {
            // set the owning side to null (unless already changed)
            if ($response->getResponseOn() === $this) {
                $response->setResponseon(null);
            }
        }

        return $this;
    }

    public function getReview(): ?Review
    {
        return $this->review;
    }

    public function setReview(?Review $review): static
    {
        $this->review = $review;

        return $this;
    }
}
