<?php
declare(strict_types=1);

namespace App\Security;

use App\Repository\UserRepository;
use Exception;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Exception\UserNotFoundException;

class UserProvider implements UserProviderInterface
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Summary of loadUserByUsername
     * @param string $email
     * @return UserInterface
     */
    public function loadUserByUsername(string $email): UserInterface
    {
        $user = $this->userRepository->findOneBy(['email' => $email]);
        if (!$user) {
            throw new UserNotFoundException();
        }
        return new UserAdapter($user);
    }

    public function loadUserByIdentifier($identifier): UserInterface
    {
        $user = $this->userRepository->findOneBy(['email' => $identifier]);

        if (!$user) {
            $exception = new UserNotFoundException();
            $exception->setUserIdentifier($identifier);
            throw $exception;
        }

        return new UserAdapter($user);
    }

    /**
     * @throws Exception
     */
    public function refreshUser(UserInterface $user): UserInterface
    {
        if (!$user instanceof UserAdapter) {
            throw new Exception(sprintf('Instances of "%s" are not supported.', \get_class($user)));
        }
        return $this->loadUserByUsername($user->getUsername());
    }

    public function supportsClass($class): bool
    {
        return UserAdapter::class === $class;
    }

    // Other required methods from UserProviderInterface...
}
