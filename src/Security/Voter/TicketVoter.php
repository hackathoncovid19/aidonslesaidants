<?php

namespace App\Security\Voter;

use App\Entity\Ticket;
use App\Entity\User;

class TicketVoter extends AbstractVoter
{
    /**
     * @var string
     */
    protected $subject = Ticket::class;

    /**
     * @param Ticket $subject
     * @param User $user
     * @return bool
     */
    protected function canView($subject, User $user): bool
    {
        return true;
    }

    /**
     * @param Ticket $subject
     * @param User $user
     * @return bool
     */
    protected function canDelete($subject, User $user): bool {
        return $this->canEdit($subject, $user);
    }

    /**
     * @param Ticket $subject
     * @param User $user
     * @return bool
     */
    protected function canEdit($subject, User $user): bool
    {
        return $subject->getUser() === $user;
    }
}