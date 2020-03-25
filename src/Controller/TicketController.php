<?php

namespace App\Controller;

use Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use Twig\Environment;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\RouterInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

use App\Entity\Ticket;
use App\Enum\TicketStatusEnum;
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
     * @var Security
     */
    private $security;

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
        RouterInterface $router,
        Security $security
    )
    {
        $this->twig = $twig;
        $this->entityManager = $entityManager;
        $this->formFactory = $formFactory;
        $this->router = $router;
        $this->security = $security;
    }

    /**
     * @Route("/view/{id}", name="view", methods={"GET"})
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
     * @Route("/list-by-user", name="view_user_list", methods={"GET"})
     *
     * @return Response
     * @throws Exception
     */
    public function viewAllByUser()
    {
        $user = $this->security->getUser();
        $tickets = $this->entityManager->getRepository(Ticket::class)->findByUser($user, ['status' => 'ASC', 'creationDate' => 'ASC']);

        $tickets = $this->orderTickets($tickets);
        $status = TicketStatusEnum::TICKET_STATUS_DATA;

        return new Response($this->twig->render('ticket/list_by_user.html.twig', [
            'tickets' => $tickets,
            'status'  => $status,
        ]));
    }

    /**
     * @Route("/new", name="create", methods={"GET","POST"})
     * @IsGranted("ROLE_USER")
     *
     * @param Request $request
     * @return Response
     * @throws Exception
     */
    public function create(Request $request)
    {
        $ticket = new Ticket();
        $form = $this->formFactory
            ->createNamedBuilder('newDemande', TicketType::class, $ticket)
            ->getForm()
            ->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ticket->setUser($this->security->getUser());
            $ticket->setStatus(TicketStatusEnum::TICKET_STATUS_OPEN);
            $this->entityManager->persist($ticket);
            $this->entityManager->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Votre demande a bien été enregistrée !');

            return new RedirectResponse($this->router->generate('ticket_view_user_list', ['id' => 1], ['_fragment' => 'validate']));
        }

        return new Response($this->twig->render('ticket/create.html.twig', [
            'form' => $form->createView(),
        ]));
    }

    /**
     * @IsGranted("EDIT", subject="ticket")
     * @Route("/edit/{id}", name="edit", methods={"GET","POST"})
     * @param Request $request
     * @param Ticket $ticket
     * @return Response|RedirectResponse
     * @throws Exception
     */
    public function edit(Request $request, Ticket $ticket)
    {
        $form = $this->formFactory->create(TicketType::class, $ticket);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $ticket = $form->getData();

            $request->getSession()->getFlashBag()->add('notice', 'Votre modification a bien été enregistrée !');

            $url = $this->router->generate('ticket_edit', ['id' => $ticket->getId()]);
            return new RedirectResponse($url, 302);
        }

        return new Response($this->twig->render('ticket/edit.html.twig', [
            'ticket' => $ticket,
            'form' => $form->createView(),
        ]));
    }

    /**
     * @IsGranted("DELETE")
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
        $tickets = $this->entityManager->getRepository(Ticket::class)->findAllOrderByStatusAndCreationDate();

        $tickets = $this->orderTickets($tickets);
        $status = TicketStatusEnum::TICKET_STATUS_DATA;

        return new Response($this->twig->render('ticket/list.html.twig', [
            'tickets' => $tickets,
            'status'  => $status,
        ]));
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
    private function orderTickets(array $tickets): array
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
