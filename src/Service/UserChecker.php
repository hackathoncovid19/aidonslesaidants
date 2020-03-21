<?php

namespace App\Service;

// use Exception;
use Symfony\Component\Security\Core\User\UserCheckerInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class UserChecker implements UserCheckerInterface
{
    /**
     * @param UserInterface $user
     */
    public function checkPreAuth(UserInterface $user)
    {
        if (!$user instanceof UserInterface) {
            return;
        }

        /*
        if (!$user->getIsOnline()) {
            throw new Exception('User has been deleted');
        }

        if ($user->getIsBanned()) {
            throw new Exception('User has been banned');
        }
        */
    }

    /**
     * @param UserInterface $user
     */
    public function checkPostAuth(UserInterface $user)
    {
        return;
    }
}
