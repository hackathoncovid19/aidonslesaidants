<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Ticket;

/**
 * @Route("/ticket", name="ticket_")
 */
class TicketController extends AbstractController
{
    /**
     * @Route("/{id}", name="view", methods={"GET"})
     * @param Request $request
     * @param Ticket $ticket
     * @return Response
     */
    public function view(Request $request, Ticket $ticket)
    {
        return $this->render('ticket/view.html.twig');
    }

    /**
     * @Route("/new", name="edit", methods={"GET","POST"})
     * @param Request $request
     */
    public function create(Request $request)
    {

    }

    /**
     * @Route("/edit/{id}", name="edit", methods={"GET","POST"})
     * @param Request $request
     * @param Ticket $ticket
     */
    public function edit(Request $request, Ticket $ticket)
    {

    }

    /**
     * @Route("/delete/{id}", name="delete", methods={"DELETE"})
     * @param Request $request
     * @param Ticket $ticket
     */
    public function delete(Request $request, Ticket $ticket)
    {

    }

    /**
     * @Route("/list", name="list", methods={"GET"})
     * @param Request $request
     */
    public function list(Request $request)
    {

    }
}
