<?php
declare(strict_types=1);

namespace App\Entity;

use App\Repository\ResponseReviewRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ResponseReviewRepository::class)]
class ResponseRequest
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'responseRequestReviewer')]
    private ?User $reviewer = null;

    #[ORM\ManyToOne(inversedBy: 'responseRequests')]
    private ?Post $post = null;

    #[ORM\ManyToOne(inversedBy: 'responseRequestsEditor')]
    private ?User $editor = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $review_start = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $review_end = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReviewer(): ?User
    {
        return $this->reviewer;
    }

    public function setReviewer(?User $reviewer): static
    {
        $this->reviewer = $reviewer;

        return $this;
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

    public function getEditor(): ?User
    {
        return $this->editor;
    }

    public function setEditor(?User $editor): static
    {
        $this->editor = $editor;

        return $this;
    }

    public function getReviewStart(): ?\DateTimeInterface
    {
        return $this->review_start;
    }

    public function setReviewStart(\DateTimeInterface $reviewStart): static
    {
        $this->review_start = $reviewStart;

        return $this;
    }

    public function getReviewEnd(): ?\DateTimeInterface
    {
        return $this->review_end;
    }

    public function setReviewEnd(\DateTimeInterface $reviewEnd): static
    {
        $this->review_end = $reviewEnd;

        return $this;
    }
}
