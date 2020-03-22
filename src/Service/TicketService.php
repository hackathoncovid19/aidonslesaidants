<?php

namespace App\Service;

use App\Enum\TicketStatusEnum;
use App\Entity\Ticket;

class TicketService 
{
    /**
    * Retourne le status suivant les dates données en parametre.
    *
    * @param \DateTime|null $assignedDate
    * @param \DateTime|null $resolvedDate
    * @return int
    */
    public static function getStatus(?\DateTime $assignedDate, ?\DateTime $resolvedDate) : int
    {
        if (!is_null($resolvedDate)) {
        return TicketStatusEnum::TICKET_STATUS_CLOSE;
        }

        if (!is_null($assignedDate)) {
          return TicketStatusEnum::TICKET_STATUS_IN_PROGRESS;
        }

        return TicketStatusEnum::TICKET_STATUS_OPEN;
    }

    /**
     * @param Ticket[] $tickets
     * @return array
     */
    public static function orderTickets(array $tickets): array
    {
        $return = [
            'open'   => [],
            'others' => []
        ];

        foreach ($tickets as $ticket) {
            if ($ticket->getStatus() === TicketStatusEnum::TICKET_STATUS_OPEN) {
                $return['open'][] = $ticket;
            } else {
                $return['others'][] = $ticket;
            }
        }

        return $return;
    }
}