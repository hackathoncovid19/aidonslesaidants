<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Twig\Environment;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Ticket;

/**
 * @Route("/ticket", name="ticket_")
 */
class TicketController
{
    /**
     * @var Environment
     */
    private $twig;

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * TicketController constructor.
     * @param Environment $twig
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(
        Environment $twig,
        EntityManagerInterface $entityManager
    )
    {
        $this->twig = $twig;
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/{id}", name="view", methods={"GET"})
     * @param Ticket $ticket
     * @return string
     * @throws Exception
     */
    public function view(Ticket $ticket)
    {
        return new Response($this->twig->render('ticket/view.html.twig', [
            'ticket' => $ticket
        ]));
    }

    /**
     * @Route("/new", name="edit", methods={"GET","POST"})
     * @throws Exception
     */
    public function create()
    {
        return new Response($this->twig->render('ticket/create.html.twig'));
    }

    /**
     * @Route("/edit/{id}", name="edit", methods={"GET","POST"})
     * @param Ticket $ticket
     * @return Response
     * @throws Exception
     */
    public function edit(Ticket $ticket)
    {
        return new Response($this->twig->render('ticket/edit.html.twig', [
            'ticket' => $ticket
        ]));
    }

    /**
     * @Route("/delete/{id}", name="delete", methods={"DELETE"})
     * @param Ticket $ticket
     */
    public function delete(Ticket $ticket)
    {

    }

    /**
     * @Route("/list", name="list", methods={"GET"})
     * @throws Exception
     */
    public function list()
    {
        $tickets = $this->entityManager->getRepository(Ticket::class)->findAll();

        return new Response($this->twig->render('ticket/list.html.twig', [
            'tickets' => $tickets
        ]));
    }
}
