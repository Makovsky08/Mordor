<?php
// src/DataFixtures/RoleFixture.php

namespace App\DataFixtures;

use App\Entity\Role;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class RoleFixture extends Fixture
{
    public const ROLES = ['ROLE_AUTHOR', 'ROLE_ADMIN', 'ROLE_REVIEWER', 'ROLE_EDITOR', 'ROLE_CHIEFEDITOR'];

    public function load(ObjectManager $manager)
    {
        foreach (self::ROLES as $roleName) {
            $role = new Role();
            $role->setRoleTitle($roleName);
            $manager->persist($role);

            // Add a reference for this role object
            $this->addReference($roleName, $role);
        }

        $manager->flush();
    }
}
