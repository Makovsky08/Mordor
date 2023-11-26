<?php
declare(strict_types=1);

namespace App\Entity;

use AllowDynamicProperties;
use App\Repository\ReviewRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[AllowDynamicProperties] #[ORM\Entity(repositoryClass: ReviewRepository::class)]
class Review
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $text = null;

    #[ORM\Column]
    private ?int $reviewer = null;

    #[ORM\Column(length: 255)]
    private ?string $created_at = null;

    #[ORM\Column]
    private ?int $topicality = null;

    #[ORM\Column]
    private ?int $originality = null;

    #[ORM\Column]
    private ?int $expertise_level = null;

    #[ORM\Column]
    private ?int $stylistics_level = null;

    #[ORM\OneToMany(mappedBy: 'review', targetEntity: Response::class)]
    private Collection $reakce;

    public function __construct() {
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

    public function getCreatedAt(): ?string
    {
        return $this->created_at;
    }

    public function setCreatedAt(string $createdAt): static
    {
        $this->created_at = $createdAt;

        return $this;
    }

    public function getReviewer(): ?int
    {
        return $this->reviewer;
    }

    public function setReviewer(int $userId): static
    {
        $this->reviewer = $userId;

        return $this;
    }

    public function getTopicality(): ?int
    {
        return $this->topicality;
    }

    public function setTopicality(int $topicality): static
    {
        $this->topicality = $topicality;

        return $this;
    }

    public function getOriginality(): ?int
    {
        return $this->originality;
    }

    public function setOriginality(int $originality): static
    {
        $this->originality = $originality;

        return $this;
    }

    public function getExpertiseLevel(): ?int
    {
        return $this->expertise_level;
    }

    public function setExpertiseLevel(int $expertiseLevel): static
    {
        $this->expertise_level = $expertiseLevel;

        return $this;
    }

    public function getStylisticsLevel(): ?int
    {
        return $this->stylistics_level;
    }

    public function setStylisticsLevel(int $stylisticsLevel): static
    {
        $this->stylistics_level = $stylisticsLevel;

        return $this;
    }

    /**
     * @return Collection<int, Response>
     */
    public function getResponse(): Collection
    {
        return $this->reakce;
    }

    public function addResponse(Response $response): static
    {
        if (!$this->reakce->contains($response)) {
            $this->reakce->add($response);
            $response->setReview($this);
        }

        return $this;
    }

    public function removeResponse(Response $response): static
    {
        if ($this->reakce->removeElement($response)) {
            // set the owning side to null (unless already changed)
            if ($response->getReview() === $this) {
                $response->setReview(null);
            }
        }

        return $this;
    }
}
