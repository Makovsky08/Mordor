<?php
namespace App\Security;

use App\Entity\Osoba; // Update with the correct namespace
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

class OsobaUserAdapter implements UserInterface, PasswordAuthenticatedUserInterface
{
    /**
     * Summary of osoba
     * @var
     */
    private $osoba;

    /**
     * Summary of __construct
     * @param \App\Entity\Osoba $osoba
     */
    public function __construct(Osoba $osoba)
    {
        $this->osoba = $osoba;
    }

    /**
     * Summary of getJmeno
     * @return string|null
     */
    public function getJmeno(): ?string
    {
        return $this->osoba->getJmeno();
    }

    /**
     * Summary of setJmeno
     * @param string $jmeno
     * @return static
     */
    public function setJmeno(string $jmeno): static
    {
        $this->osoba->setJmeno($jmeno);

        return $this;
    }

    /**
     * Summary of getPrijmeni
     * @return string|null
     */
    public function getPrijmeni(): ?string
    {
        return $this->osoba->getPrijmeni();
    }

    /**
     * Summary of setPrijmeni
     * @param string $prijmeni
     * @return static
     */
    public function setPrijmeni(string $prijmeni): static
    {
        $this->osoba->setPrijmeni($prijmeni);

        return $this;
    }

    /**
     * Summary of getDatumNarozeni
     * @return \DateTimeInterface|null
     */
    public function getDatumNarozeni(): ?\DateTimeInterface
    {
        return $this->osoba->getDatumNarozeni();
    }

    /**
     * Summary of setDatumNarozeni
     * @param \DateTimeInterface $datum_narozeni
     * @return static
     */
    public function setDatumNarozeni(\DateTimeInterface $datum_narozeni): static
    {
        $this->osoba->setDatumNarozeni($datum_narozeni);

        return $this;
    }

    /**
     * Summary of getEmail
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->osoba->getEmail();
    }

    /**
     * Summary of setEmail
     * @param string $email
     * @return static
     */
    public function setEmail(string $email): static
    {
        $this->osoba->setEmail($email);

        return $this;
    }

    /**
     * Summary of getHeslo
     * @return string|null
     */
    public function getHeslo(): ?string
    {
        return $this->osoba->getHeslo();
    }

    /**
     * Summary of setHeslo
     * @param string $heslo
     * @return static
     */
    public function setHeslo(string $heslo): static
    {
        $this->osoba->setHeslo($heslo);

        return $this;
    }

    /**
     * Summary of getRoles
     * @return array
     */
    public function getRoles(): array
    {
        // Adapt the getRoles method to return a string array as expected by Symfony
        return $this->osoba->getRoleStrings();
    }

    /**
     * Summary of getPassword
     * @return string
     */
    public function getPassword(): ?string
    {
        // Return the password from the Osoba entity
        return $this->osoba->getPassword();
    }

    /**
     * Summary of setPassword
     * @param string $password
     * @return static
     */
    public function setPassword(string $password): static
    {
        // Set the password on the Osoba entity
        $this->osoba->setPassword($password);

        return $this;
    }

    /**
     * Summary of getSalt
     * @return null
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
    public function getUsername(): string
    {
        // Adapt to use the appropriate method from the Osoba entity
        return $this->osoba->getEmail();
    }

    /**
     * Summary of eraseCredentials
     * @return void
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->osoba->eraseCredentials();
    }

    /**
     * Summary of getUserIdentifier
     * @return string
     */
    public function getUserIdentifier(): string
    {
        // This method is required in Symfony 5.3+
        // Replace with the appropriate identifier field from your Osoba entity
        return $this->osoba->getEmail(); // or getUsername(), if it's different
    }

    // Delegate any other necessary methods to the Osoba entity:
    // e.g., if Osoba has a method for a refresh token, API token, etc.
}
