<?php
namespace App\Form\DataTransformer;

use App\Entity\Role;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class StringToRoleTransformer implements DataTransformerInterface
{
    private $entityManager;
    private $logger;

    public function __construct(EntityManagerInterface $entityManager, LoggerInterface $logger)
    {
        $this->entityManager = $entityManager;
        $this->logger = $logger;
    }

    public function transform($value): array
    {
        if ($value === null) {
            return [];
        }

        // Transform from collection of Role entities to an array of strings
        if ($value instanceof Collection) {
            return $value->map(function(Role $role) {
                return (string) $role; // A method to return the string representation
            })->toArray();
        }

        return [];
    }

    public function reverseTransform($rolesAsStringArray): Collection
    {
        $roles = new ArrayCollection();

        foreach ($rolesAsStringArray as $roleString) {
            // Fetch the Role entity by the string identifier
            $role = $this->entityManager->getRepository(Role::class)->findOneBy(['jmeno_role' => $roleString]);

            if ($role) {
                $roles->add($role);
                // Log each role entity
                $this->logger->info('Adding role entity to collection', ['role' => $role->getJmenoRole()]);
            } else {
                // Log a warning if the role was not found
                $this->logger->warning('Role entity not found', ['roleString' => $roleString]);
            }
        }

        // Log the final collection
        $this->logger->info('Final role collection', ['roles' => $roles->toArray()]);

        return $roles;
    }
}
