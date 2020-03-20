<?php

namespace App\Controller;

use Exception;
use Twig\Environment;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

use App\Entity\Ticket;
use App\Form\TicketType;

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
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * @var RouterInterface
     */
    private $router;

    /**
     * TicketController constructor.
     * @param Environment $twig
     * @param EntityManagerInterface $entityManager
     * @param FormFactoryInterface $formFactory
     * @param RouterInterface $router
     */
    public function __construct(
        Environment $twig,
        EntityManagerInterface $entityManager,
        FormFactoryInterface $formFactory,
        RouterInterface $router
    )
    {
        $this->twig = $twig;
        $this->entityManager = $entityManager;
        $this->formFactory = $formFactory;
        $this->router = $router;
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
        $form = $this->formFactory->create(TicketType::class, $ticket);

        $form->handleRequest($ticket);
        if ($form->isSubmitted() && $form->isValid()) {
            $ticket = $form->getData();

            $url = $this->router->generate('ticket_view', [$ticket]);
            return new RedirectResponse($url, 302);
        }

        return new Response($this->twig->render('ticket/edit.html.twig', [
            'ticket' => $ticket,
            'form' => $form->createView(),
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
