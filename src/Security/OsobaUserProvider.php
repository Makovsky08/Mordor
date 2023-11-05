<?php
namespace App\Security;

use App\Repository\OsobaRepository;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Exception\UserNotFoundException;


class OsobaUserProvider implements UserProviderInterface
{
    private $osobaRepository;

    public function __construct(OsobaRepository $osobaRepository)
    {
        $this->osobaRepository = $osobaRepository;
    }

    /**
     * Summary of loadUserByUsername
     * @param string $username
     * @throws \Symfony\Component\Security\Core\Exception\UserNotFoundException
     * @return \Symfony\Component\Security\Core\User\UserInterface
     */
    public function loadUserByUsername(string $email): UserInterface
    {
        $osoba = $this->osobaRepository->findOneBy(['email' => $email]);
        if (!$osoba) {
            throw new UserNotFoundException();
        }
        return new OsobaUserAdapter($osoba);
    }

    public function loadUserByIdentifier($identifier): UserInterface
    {
        $osoba = $this->osobaRepository->findOneBy(['email' => $identifier]);

        if (!$osoba) {
            $exception = new UserNotFoundException();
            $exception->setUserIdentifier($identifier);
            throw $exception;
        }

        return new OsobaUserAdapter($osoba);
    }

    public function refreshUser(UserInterface $user): UserInterface
    {
        if (!$user instanceof OsobaUserAdapter) {
            throw new \Exception(sprintf('Instances of "%s" are not supported.', \get_class($user)));
        }
        return $this->loadUserByUsername($user->getUsername());
    }

    public function supportsClass($class): bool
    {
        return OsobaUserAdapter::class === $class;
    }

    // Other required methods from UserProviderInterface...
}
