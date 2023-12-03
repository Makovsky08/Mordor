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

    #[ORM\OneToMany(mappedBy: 'post', targetEntity: VersionPost::class, orphanRemoval: true)]
    private Collection $versionPosts;

    #[ORM\OneToOne(mappedBy: 'post', targetEntity: VersionPost::class, orphanRemoval: true)]
    private VersionPost $versionPost;

    #[ORM\ManyToMany(targetEntity: Release::class, mappedBy: 'post')]
    private Collection $release;

    #[ORM\OneToMany(mappedBy: 'post', targetEntity: StatusPost::class, orphanRemoval: true)]
    private Collection $statusPosts;

    #[ORM\OneToMany(mappedBy: 'related_post', targetEntity: Response::class)]
    private Collection $responses;

    #[ORM\OneToMany(mappedBy: 'related_post', targetEntity: Review::class)]
    private Collection $reviews;

    #[ORM\OneToMany(mappedBy: 'post', targetEntity: ResponseRequest::class)]
    private Collection $responseRequests;

    public function __construct()
    {
        $this->versionPosts = new ArrayCollection();
        $this->release = new ArrayCollection();
        $this->statusPosts = new ArrayCollection();
        $this->responses = new ArrayCollection();
        $this->reviews = new ArrayCollection();
        $this->responseRequests = new ArrayCollection();
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
     * @return Collection<int, VersionPost>
     */
    public function getVersionPosts(): Collection
    {
        return $this->versionPosts;
    }

    public function getVersionPost(int $version): ?VersionPost
    {
        return $this->versionPosts->get($version);
    }

    public function addVersionPost(VersionPost $versionPost): static
    {
        if (!$this->versionPosts->contains($versionPost)) {
            $this->versionPosts->add($versionPost);
            $versionPost->setPost($this);
        }

        return $this;
    }

    public function removeVersionPost(VersionPost $versionPost): static
    {
        if ($this->versionPosts->removeElement($versionPost)) {
            // set the owning side to null (unless already changed)
            if ($versionPost->getPost() === $this) {
                $versionPost->setPost(null);
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
     * @return Collection<int, StatusPost>
     */
    public function getStatusPosts(): Collection
    {
        return $this->statusPosts;
    }

    public function addStatusPost(StatusPost $statusPost): static
    {
        if (!$this->statusPosts->contains($statusPost)) {
            $this->statusPosts->add($statusPost);
            $statusPost->setPost($this);
        }

        return $this;
    }

    public function removeStatusPost(StatusPost $statusPost): static
    {
        if ($this->statusPosts->removeElement($statusPost)) {
            // set the owning side to null (unless already changed)
            if ($statusPost->getPost() === $this) {
                $statusPost->setPost(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Response>
     */
    public function getResponses(): Collection
    {
        return $this->responses;
    }

    public function addResponse(Response $response): static
    {
        if (!$this->responses->contains($response)) {
            $this->responses->add($response);
            $response->setRelatedPost($this);
        }

        return $this;
    }

    public function removeResponse(Response $response): static
    {
        if ($this->responses->removeElement($response)) {
            // set the owning side to null (unless already changed)
            if ($response->getRelatedPost() === $this) {
                $response->setRelatedPost(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, ResponseRequest>
     */
    public function getResponseRequests(): Collection
    {
        return $this->responseRequests;
    }

    public function addResponseRequestPost(ResponseRequest $responseRequest): static
    {
        if (!$this->responseRequests->contains($responseRequest)) {
            $this->responseRequests->add($responseRequest);
            $responseRequest->setPost($this);
        }

        return $this;
    }

    public function removeResponseRequestPost(ResponseRequest $responseRequest): static
    {
        if ($this->responseRequests->removeElement($responseRequest)) {
            // set the owning side to null (unless already changed)
            if ($responseRequest->getPost() === $this) {
                $responseRequest->setPost(null);
            }
        }

        return $this;
    }
}
