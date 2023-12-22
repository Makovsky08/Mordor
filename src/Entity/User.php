<?php
declare(strict_types=1);

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="person")
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: "person")]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $surname = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $birthdate = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $password = null;

    #[ORM\ManyToMany(targetEntity: Role::class, inversedBy: 'users')]
    #[ORM\JoinTable(name: 'user_role')]
    #[ORM\JoinColumn(name: 'user_id', referencedColumnName: 'id')]
    #[ORM\InverseJoinColumn(name: 'role_id', referencedColumnName: 'id')]
    private Collection $roles;

    #[ORM\OneToMany(mappedBy: 'author', targetEntity: Post::class, orphanRemoval: true)]
    private Collection $posts;

    #[ORM\OneToMany(mappedBy: 'From', targetEntity: Response::class)]
    private Collection $responseFrom;

    #[ORM\OneToMany(mappedBy: 'To', targetEntity: Response::class)]
    private Collection $responseTo;

    #[ORM\OneToMany(mappedBy: 'Reviewer', targetEntity: ResponseRequest::class)]
    private Collection $responseRequestReviewer;

    #[ORM\OneToMany(mappedBy: 'editor', targetEntity: ResponseRequest::class)]
    private Collection $responseRequestEditor;



    public function __construct()
    {
        $this->roles = new ArrayCollection();
        $this->posts = new ArrayCollection();
        $this->responseFrom = new ArrayCollection();
        $this->responseTo = new ArrayCollection();
        $this->responseRequestReviewer = new ArrayCollection();
        $this->responseRequestEditor = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): static
    {
        $this->surname = $surname;

        return $this;
    }

    public function getBirthdate(): ?\DateTimeInterface
    {
        return $this->birthdate;
    }

    public function setBirthdate(\DateTimeInterface $birthdate): static
    {
        $this->birthdate = $birthdate;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @return Role[]
     */
    public function getRoles(): array
    {
        return $this->roles->toArray();
    }

        /**
     * @return string[]
     */
    public function getRoleStrings(): array
    {
        return $this->roles->map(function ($role) {
            return (string) $role;
        })->toArray();
    }

    public function addRole(Role $role): self
    {
        if (!$this->roles->contains($role)) {
            $this->roles[] = $role;
        }

        return $this;
    }

    public function removeRole(Role $role): self
    {
        $this->roles->removeElement($role);

        return $this;
    }

    /**
     * @return Collection<int, Post>
     */
    public function getPosts(): Collection
    {
        return $this->posts;
    }

    public function addPost(Post $post): static
    {
        if (!$this->posts->contains($post)) {
            $this->posts->add($post);
            $post->setAuthor($this);
        }

        return $this;
    }

    public function removePost(Post $post): static
    {
        if ($this->posts->removeElement($post)) {
            // set the owning side to null (unless already changed)
            if ($post->getAuthor() === $this) {
                $post->setAuthor(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Response>
     */
    public function getResponseFrom(): Collection
    {
        return $this->responseFrom;
    }

    public function addResponseFrom(Response $response): static
    {
        if (!$this->responseFrom->contains($response)) {
            $this->responseFrom->add($response);
            $response->setResponseFrom($this);
        }

        return $this;
    }

    public function removeResponseFrom(Response $response): static
    {
        if ($this->responseFrom->removeElement($response)) {
            // set the owning side to null (unless already changed)
            if ($response->getResponseFrom() === $this) {
                $response->setResponseFrom(null);
            }
        }

        return $this;
    }


    /**
     * @return Collection<int, Response>
     */
    public function getResponseTo(): Collection
    {
        return $this->responseTo;
    }

    public function addResponseTo(Response $response): static
    {
        if (!$this->responseTo->contains($response)) {
            $this->responseTo->add($response);
            $response->setResponseFrom($this);
        }

        return $this;
    }

    public function removeResponseTo(Response $response): static
    {
        if ($this->responseTo->removeElement($response)) {
            // set the owning side to null (unless already changed)
            if ($response->getResponseTo() === $this) {
                $response->setResponseTo(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, ResponseRequest>
     */
    public function getResponseRequestReviewer(): Collection
    {
        return $this->responseRequestReviewer;
    }

    public function addResponseRequestReviewer(ResponseRequest $responseRequest): static
    {
        if (!$this->responseRequestReviewer->contains($responseRequest)) {
            $this->responseRequestReviewer->add($responseRequest);
            $responseRequest->setReviewer($this);
        }

        return $this;
    }

    public function removeResponseRequestReviewer(ResponseRequest $responseRequest): static
    {
        if ($this->responseRequestReviewer->removeElement($responseRequest)) {
            // set the owning side to null (unless already changed)
            if ($responseRequest->getReviewer() === $this) {
                $responseRequest->setReviewer(null);
            }
        }

        return $this;
    }


        /**
     * @return Collection<int, ResponseRequest>
     */
    public function getResponseRequestEditor(): Collection
    {
        return $this->responseRequestEditor;
    }

    public function addResponseRequestEditor(ResponseRequest $responseRequest): static
    {
        if (!$this->responseRequestEditor->contains($responseRequest)) {
            $this->responseRequestEditor->add($responseRequest);
            $responseRequest->setEditor($this);
        }

        return $this;
    }

    public function removeResponseRequestEditor(ResponseRequest $responseRequest): static
    {
        if ($this->responseRequestEditor->removeElement($responseRequest)) {
            // set the owning side to null (unless already changed)
            if ($responseRequest->getEditor() === $this) {
                $responseRequest->setEditor(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->getName() . " " . $this->getSurname();
    }

    public function getSalt(): ?string
    {
        // If you are using bcrypt or argon2i, the salt is not needed
        return null;
    }

    public function getUserIdentifier(): string
    {
        // Use the property that represents the username in your entity
        return $this->email; // or username if it's a username
    }

    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }
}




