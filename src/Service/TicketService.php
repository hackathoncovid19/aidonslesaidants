<?php

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use App\Enum\TicketStatusEnum;

class TicketService 
{
   /**
   * Retourne le status suivant les dates données en parametre.
   *
   * @param datetime $creationDate
   * @param ?datetime $assignedDate
   * @param ?datetime $resolvedDate
   * @return int 
   */
  public function getStatus(?datetime $assignedDate, ?datetime $resolvedDate) : int
  {
      $statusState = 1;
      
      if(!is_null($assignedDate))
      {
        $statusState = 2;
      }  

      if(!is_null($resolvedDate))
      {
        $statusState = 3;
      }  

      return $statusState;
  }

  /**
     *
     *
     * PRIVATE
     *
     */

    /**
     * @param Ticket[] $tickets
     * @return array
     */
    public function orderTickets(array $tickets): array
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