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

    #[ORM\OneToMany(mappedBy: 'Author', targetEntity: Post::class, orphanRemoval: true)]
    private Collection $posts;

    #[ORM\OneToMany(mappedBy: 'Odkoho', targetEntity: Reakce::class)]
    private Collection $reakcesOdkoho;

    #[ORM\OneToMany(mappedBy: 'Komu', targetEntity: Reakce::class)]
    private Collection $reakcesKomu;

    #[ORM\OneToMany(mappedBy: 'Reviewer', targetEntity: PozadavekNaRecenciPrispevku::class)]
    private Collection $pozadavekNaRecenciPrispevkusRecenzent;

    #[ORM\OneToMany(mappedBy: 'Redaktor', targetEntity: PozadavekNaRecenciPrispevku::class)]
    private Collection $pozadavekNaRecenciPrispevkusRedaktor;



    public function __construct()
    {
        $this->roles = new ArrayCollection();
        $this->posts = new ArrayCollection();
        $this->reakcesOdkoho = new ArrayCollection();
        $this->reakcesKomu = new ArrayCollection();
        $this->pozadavekNaRecenciPrispevkusRecenzent = new ArrayCollection();
        $this->pozadavekNaRecenciPrispevkusRedaktor = new ArrayCollection();
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
     * @return Collection<int, Reakce>
     */
    public function getreakcesOdkoho(): Collection
    {
        return $this->reakcesOdkoho;
    }

    public function addReakceOdkoho(Reakce $reakce): static
    {
        if (!$this->reakcesOdkoho->contains($reakce)) {
            $this->reakcesOdkoho->add($reakce);
            $reakce->setOdkoho($this);
        }

        return $this;
    }

    public function removeReakceOdkoho(Reakce $reakce): static
    {
        if ($this->reakcesOdkoho->removeElement($reakce)) {
            // set the owning side to null (unless already changed)
            if ($reakce->getOdkoho() === $this) {
                $reakce->setOdkoho(null);
            }
        }

        return $this;
    }


    /**
     * @return Collection<int, Reakce>
     */
    public function getreakcesKomu(): Collection
    {
        return $this->reakcesKomu;
    }

    public function addReakceKomu(Reakce $reakce): static
    {
        if (!$this->reakcesKomu->contains($reakce)) {
            $this->reakcesKomu->add($reakce);
            $reakce->setOdkoho($this);
        }

        return $this;
    }

    public function removeReakceKomu(Reakce $reakce): static
    {
        if ($this->reakcesKomu->removeElement($reakce)) {
            // set the owning side to null (unless already changed)
            if ($reakce->getKomu() === $this) {
                $reakce->setKomu(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, PozadavekNaRecenciPrispevku>
     */
    public function getpozadavekNaRecenciPrispevkusRecenzent(): Collection
    {
        return $this->pozadavekNaRecenciPrispevkusRecenzent;
    }

    public function addPozadavekNaRecenciPrispevkuRecenzent(PozadavekNaRecenciPrispevku $pozadavekNaRecenciPrispevku): static
    {
        if (!$this->pozadavekNaRecenciPrispevkusRecenzent->contains($pozadavekNaRecenciPrispevku)) {
            $this->pozadavekNaRecenciPrispevkusRecenzent->add($pozadavekNaRecenciPrispevku);
            $pozadavekNaRecenciPrispevku->setRecenzent($this);
        }

        return $this;
    }

    public function removePozadavekNaRecenciPrispevkuRecenzent(PozadavekNaRecenciPrispevku $pozadavekNaRecenciPrispevku): static
    {
        if ($this->pozadavekNaRecenciPrispevkusRecenzent->removeElement($pozadavekNaRecenciPrispevku)) {
            // set the owning side to null (unless already changed)
            if ($pozadavekNaRecenciPrispevku->getRecenzent() === $this) {
                $pozadavekNaRecenciPrispevku->setRecenzent(null);
            }
        }

        return $this;
    }


        /**
     * @return Collection<int, PozadavekNaRecenciPrispevku>
     */
    public function getpozadavekNaRecenciPrispevkusRedaktor(): Collection
    {
        return $this->pozadavekNaRecenciPrispevkusRedaktor;
    }

    public function addPozadavekNaRecenciPrispevkuRedaktor(PozadavekNaRecenciPrispevku $pozadavekNaRecenciPrispevku): static
    {
        if (!$this->pozadavekNaRecenciPrispevkusRedaktor->contains($pozadavekNaRecenciPrispevku)) {
            $this->pozadavekNaRecenciPrispevkusRedaktor->add($pozadavekNaRecenciPrispevku);
            $pozadavekNaRecenciPrispevku->setRedaktor($this);
        }

        return $this;
    }

    public function removePozadavekNaRecenciPrispevkuRedaktor(PozadavekNaRecenciPrispevku $pozadavekNaRecenciPrispevku): static
    {
        if ($this->pozadavekNaRecenciPrispevkusRedaktor->removeElement($pozadavekNaRecenciPrispevku)) {
            // set the owning side to null (unless already changed)
            if ($pozadavekNaRecenciPrispevku->getRedaktor() === $this) {
                $pozadavekNaRecenciPrispevku->setRedaktor(null);
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




