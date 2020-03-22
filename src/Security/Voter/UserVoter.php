<?php

namespace App\Security\Voter;

use App\Entity\User;

class UserVoter extends AbstractVoter
{
    /**
     * @var string
     */
    protected $subject = User::class;

    /**
     * @param User $subject
     * @param User $user
     * @return bool
     */
    protected function canView($subject, User $user): bool
    {
        return $this->canEdit($subject, $user);
    }

    /**
     * @param User $subject
     * @param User $user
     * @return bool
     */
    protected function canDelete($subject, User $user): bool
    {
        return false;
    }

    /**
     * @param User $subject
     * @param User $user
     * @return bool
     */
    protected function canEdit($subject, User $user): bool
    {
        return $subject->getId() === $user->getId();
    }
}