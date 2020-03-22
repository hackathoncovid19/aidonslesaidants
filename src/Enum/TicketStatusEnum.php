<?php

namespace App\Enum;

class TicketStatusEnum
{
    const TICKET_STATUS_OPEN        = 1;
    const TICKET_STATUS_IN_PROGRESS = 2;
    const TICKET_STATUS_CLOSE       = 3;

    const TICKET_STATUS_DATA = [
        self::TICKET_STATUS_OPEN => [
            'name'      => 'Ouvert',
            'cssClass' => 'open',
        ],
        self::TICKET_STATUS_IN_PROGRESS => [
            'name'      => 'En cours',
            'cssClass' => 'in-progress',
        ],
        self::TICKET_STATUS_CLOSE => [
            'name'      => 'Terminé',
            'cssClass' => 'close',
        ],
    ];
}
