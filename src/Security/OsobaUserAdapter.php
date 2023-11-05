<?php
namespace App\Security;

use App\Entity\Osoba; // Update with the correct namespace
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

class OsobaUserAdapter implements UserInterface, PasswordAuthenticatedUserInterface
{
    private $osoba;

    public function __construct(Osoba $osoba)
    {
        $this->osoba = $osoba;
    }

    public function getJmeno(): ?string
    {
        return $this->osoba->getJmeno();
    }

    public function setJmeno(string $jmeno): static
    {
        $this->osoba->setJmeno($jmeno);

        return $this;
    }

    public function getPrijmeni(): ?string
    {
        return $this->osoba->getPrijmeni();
    }

    public function setPrijmeni(string $prijmeni): static
    {
        $this->osoba->setPrijmeni($prijmeni);

        return $this;
    }

    public function getDatumNarozeni(): ?\DateTimeInterface
    {
        return $this->osoba->getDatumNarozeni();
    }

    public function setDatumNarozeni(\DateTimeInterface $datum_narozeni): static
    {
        $this->osoba->setDatumNarozeni($datum_narozeni);

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->osoba->getEmail();
    }

    public function setEmail(string $email): static
    {
        $this->osoba->setEmail($email);

        return $this;
    }

    public function getHeslo(): ?string
    {
        return $this->osoba->getHeslo();
    }

    public function setHeslo(string $heslo): static
    {
        $this->osoba->setHeslo($heslo);

        return $this;
    }

    public function getRoles(): array
    {
        // Adapt the getRoles method to return a string array as expected by Symfony
        return $this->osoba->getRoleStrings();
    }

    public function getPassword(): ?string
    {
        // Return the password from the Osoba entity
        return $this->osoba->getPassword();
    }

    public function setPassword(string $password): static
    {
        // Set the password on the Osoba entity
        $this->osoba->setPassword($password);

        return $this;
    }

    public function getSalt(): ?string
    {
        // If you're using bcrypt, argon2i, argon2id, or sodium as your
        // password encoder (as Symfony recommends), then the salts are
        // built into the encoded password and you do not need to return anything here.
        return null;
    }

    public function getUsername(): string
    {
        // Adapt to use the appropriate method from the Osoba entity
        return $this->osoba->getEmail();
    }

    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->osoba->eraseCredentials();
    }

    public function getUserIdentifier(): string
    {
        // This method is required in Symfony 5.3+
        // Replace with the appropriate identifier field from your Osoba entity
        return $this->osoba->getEmail(); // or getUsername(), if it's different
    }

    // Delegate any other necessary methods to the Osoba entity:
    // e.g., if Osoba has a method for a refresh token, API token, etc.
}
