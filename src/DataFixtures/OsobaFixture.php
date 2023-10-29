<?php
// src/DataFixtures/OsobaFixture.php

namespace App\DataFixtures;

use App\Entity\Osoba;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class OsobaFixture extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        for ($i = 1; $i <= 10; $i++) {
            $osoba = new Osoba();
            $osoba->setJmeno('Jméno' . $i);
            $osoba->setPrijmeni('Příjmení' . $i);
            $osoba->setDatumNarozeni(new \DateTime('1990-01-01'));
            $osoba->setEmail('email' . $i . '@example.com');
            $osoba->setHeslo('password');

            // Assign roles to Osoba
            $osoba->addRole($this->getReference(RoleFixture::ROLES[array_rand(RoleFixture::ROLES)]));

            $manager->persist($osoba);
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
