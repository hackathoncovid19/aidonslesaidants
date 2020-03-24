<?php

namespace App\Enum;

use App\Entity\Ticket;

class TicketStatusEnum
{
    const TICKET_STATUS_DATA = [
        Ticket::STATUS_OPEN => [
            'name'      => 'Ouvert',
            'cssClass' => 'open',
        ],
        Ticket::STATUS_IN_PROGRESS => [
            'name'      => 'En cours',
            'cssClass' => 'in-progress',
        ],
        Ticket::STATUS_CLOSE => [
            'name'      => 'Terminé',
            'cssClass' => 'close',
        ],
    ];
}
