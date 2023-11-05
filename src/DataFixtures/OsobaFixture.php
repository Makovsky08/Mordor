<?php
// src/DataFixtures/OsobaFixture.php

namespace App\DataFixtures;

use App\Entity\Osoba;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class OsobaFixture extends Fixture implements DependentFixtureInterface
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }
    public function load(ObjectManager $manager)
    {
        for ($i = 1; $i <= 10; $i++) {
            // Create your user entity
            $user = new Osoba();
            $user->setEmail("user$i@example.com");
            $user->setJmeno("User$i");
            $user->setPrijmeni("Prijmeni$i");
            $user->setDatumNarozeni(new \DateTime());
            $user->addRole($this->getReference(RoleFixture::ROLES[array_rand(RoleFixture::ROLES)]));
            // Set other properties like username, etc.
            // ...

            // Hash the password
            $plaintextPassword = 'password123'; // The plaintext password you want to set
            $hashedPassword = $this->passwordHasher->hashPassword(
                $user,
                $plaintextPassword
            );

            // Set the hashed password
            $user->setHeslo($hashedPassword);

            // Maybe set roles or other fields for the user
            // ...

            // Persist the user entity
            $manager->persist($user);
    }
    $manager->flush();
}

    public function getDependencies()
    {
        return [
            RoleFixture::class,
        ];
    }
}
