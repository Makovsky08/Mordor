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
    private ?\DateTimeInterface $start_review = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $end_review = null;

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

    public function getStartReview(): ?\DateTimeInterface
    {
        return $this->start_review;
    }

    public function setStartReview(\DateTimeInterface $reviewStart): static
    {
        $this->start_review = $reviewStart;

        return $this;
    }

    public function getEndReview(): ?\DateTimeInterface
    {
        return $this->end_review;
    }

    public function setEndReview(\DateTimeInterface $reviewEnd): static
    {
        $this->end_review = $reviewEnd;

        return $this;
    }
}
