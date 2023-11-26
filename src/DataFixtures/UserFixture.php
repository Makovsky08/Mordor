<?php
declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\User;
use App\Security\UserAdapter;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixture extends Fixture implements DependentFixtureInterface
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
            $user = new User();
            $user->setEmail("user$i@example.com");
            $user->setName("user$i");
            $user->setSurname("Prijmeni$i");
            $user->setBirthdate(new \DateTime());


            if($i == 1) {
                $user->addRole($this->getReference(RoleFixture::ROLES[0]));
                $user->addRole($this->getReference(RoleFixture::ROLES[1]));
                $user->addRole($this->getReference(RoleFixture::ROLES[2]));
                $user->addRole($this->getReference(RoleFixture::ROLES[3]));
                $user->addRole($this->getReference(RoleFixture::ROLES[4]));
            }
            else {
                $user->addRole($this->getReference(RoleFixture::ROLES[array_rand(RoleFixture::ROLES)]));
            }
            // Set other properties like username, etc.
            // ...

            $userAdapter = new UserAdapter($user);

            // Hash the password
            $plaintextPassword = 'password123'; // The plaintext password you want to set
            $hashedPassword = $this->passwordHasher->hashPassword(
                $userAdapter,
                $plaintextPassword
            );


            $userAdapter->setPassword($hashedPassword);

            // Set the hashed password
            $user->setPassword($hashedPassword);

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
