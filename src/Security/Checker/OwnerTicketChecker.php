<?php

namespace App\Security\Checker;

use App\Entity\Ticket;
use App\Entity\User;

class OwnerTicketChecker
{
    /**
     * @param User $user
     * @param Ticket $ticket
     * @return bool
     */
    public function isOwnerOf(User $user, Ticket $ticket): bool
    {
        return $user === $ticket->getUser();
    }
}