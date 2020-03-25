<?php

namespace App\Security\Voter;

use App\Entity\Ticket;
use App\Entity\User;
use App\Security\Checker\OwnerTicketChecker;
use Symfony\Component\Security\Core\Security;

class TicketVoter extends AbstractVoter
{
    /**
     * @var OwnerTicketChecker
     */
    private $ownerTicketChecker;

    /**
     * TicketVoter constructor.
     * @param Security $security
     * @param OwnerTicketChecker $ownerTicketChecker
     */
    public function __construct(Security $security, OwnerTicketChecker $ownerTicketChecker)
    {
        parent::__construct($security);
        $this->ownerTicketChecker = $ownerTicketChecker;
    }

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
        return $this->ownerTicketChecker->isOwnerOf($user, $subject);
    }
}