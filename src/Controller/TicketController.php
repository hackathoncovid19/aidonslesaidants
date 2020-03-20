<?php

namespace App\Controller;

use Exception;
use Twig\Environment;

use Laminas\Hydrator\ObjectPropertyHydrator;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Ticket;

/**
 * @Route("/ticket", name="ticket_")
 */
class TicketController
{
    /**
     * @var ObjectPropertyHydrator
     */
    private $hydrator;

    /**
     * @var Environment
     */
    private $twig;

    /**
     * TicketController constructor.
     * @param Environment $twig
     * @param ObjectPropertyHydrator $hydrator
     */
    public function __construct(Environment $twig, ObjectPropertyHydrator $hydrator)
    {
        $this->twig = $twig;
        $this->hydrator = $hydrator;
    }

    /**
     * @Route("/{id}", name="view", methods={"GET"})
     * @param Ticket $ticket
     * @return string
     * @throws Exception
     */
    public function view(Ticket $ticket)
    {
        return new Response($this->twig->render('ticket/view.html.twig'));

    }

    /**
     * @Route("/new", name="edit", methods={"GET","POST"})
     * @param Request $request
     */
    public function create()
    {

    }

    /**
     * @Route("/edit/{id}", name="edit", methods={"GET","POST"})
     * @param Request $request
     * @param Ticket $ticket
     */
    public function edit(Ticket $ticket)
    {

    }

    /**
     * @Route("/delete/{id}", name="delete", methods={"DELETE"})
     * @param Request $request
     * @param Ticket $ticket
     */
    public function delete(Ticket $ticket)
    {

    }

    /**
     * @Route("/list", name="list", methods={"GET"})
     * @param Request $request
     */
    public function list()
    {

    }
}
