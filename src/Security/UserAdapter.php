<?php
declare(strict_types=1);

namespace App\Security;

use App\Entity\User; // Update with the correct namespace
use DateTimeInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

class UserAdapter implements UserInterface, PasswordAuthenticatedUserInterface
{
    /**
     * Summary of user
     * @var
     */
    private $user;

    /**
     * Summary of __construct
     * @param \App\Entity\User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Summary of getName
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->user->getName();
    }

    /**
     * Summary of setName
     * @param string $name
     * @return static
     */
    public function setName(string $name): static
    {
        $this->user->setName($name);

        return $this;
    }



    /**
     * Summary of getSurname
     * @return string|null
     */
    public function getSurname(): ?string
    {
        return $this->user->getSurname();
    }

    /**
     * Summary of setSurname
     * @param string $surname
     * @return static
     */
    public function setSurname(string $surname): static
    {
        $this->user->setSurname($surname);

        return $this;
    }

    /**
     * Summary of getBirthdate
     * @return DateTimeInterface|null
     */
    public function getBirthdate(): ?DateTimeInterface
    {
        return $this->user->getBirthdate();
    }

    public function getPassword(): ?string
    {
        return $this->user->getPassword();
    }

    /**
     * Summary of setBirthdate
     * @param DateTimeInterface $birthdate
     * @return static
     */
    public function setBirthdate(DateTimeInterface $birthdate): static
    {
        $this->user->setBirthdate($birthdate);

        return $this;
    }

    /**
     * Summary of getEmail
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->user->getEmail();
    }

    /**
     * Summary of setEmail
     * @param string $email
     * @return static
     */
    public function setEmail(string $email): static
    {
        $this->user->setEmail($email);

        return $this;
    }

    /**
     * Summary of setPassword
     * @param string $password
     * @return static
     */
    public function setPassword(string $password): static
    {
        $this->user->setPassword($password);

        return $this;
    }

    /**
     * Summary of getRoles
     * @return array
     */
    public function getRoles(): array
    {
        // Adapt the getRoles method to return a string array as expected by Symfony
        return $this->user->getRoleStrings();
    }

    /**
     * Summary of getSalt
     * @return string|null
     */
    public function getSalt(): ?string
    {
        // If you're using bcrypt, argon2i, argon2id, or sodium as your
        // password encoder (as Symfony recommends), then the salts are
        // built into the encoded password and you do not need to return anything here.
        return null;
    }

    /**
     * Summary of getUsername
     * @return string
     */
    public function getUserEntity(): User
{
    return $this->user;
}
    public function getUsername(): string
    {
        // Adapt to use the appropriate method from the user entity
        return $this->user->getEmail();
    }

    /**
     * Summary of eraseCredentials
     * @return void
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->user->eraseCredentials();
    }

    /**
     * Summary of getUserIdentifier
     * @return string
     */
    public function getUserIdentifier(): string
    {
        // This method is required in Symfony 5.3+
        // Replace with the appropriate identifier field from your user entity
        return $this->user->getEmail(); // or getUsername(), if it's different
    }

    // Delegate any other necessary methods to the user entity:
    // e.g., if user has a method for a refresh token, API token, etc.
}
