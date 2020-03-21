<?php

namespace App\Controller;

use Exception;
use Twig\Environment;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

use App\Entity\User;
use App\Form\UserType;

/**
 * @Route("/user", name="user_")
 */
class UserController
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
     * @var AuthorizationCheckerInterface
     */
    private $authenticationChecker;


    /**
     * @var AuthenticationUtils
     */
    private $authenticationUtils;

    /**
     * UserController constructor.
     * @param Environment $twig
     * @param EntityManagerInterface $entityManager
     * @param FormFactoryInterface $formFactory
     * @param RouterInterface $router ,
     * @param AuthorizationCheckerInterface $authenticationChecker
     * @param AuthenticationUtils $authenticationUtils
     */
    public function __construct(
        Environment $twig,
        EntityManagerInterface $entityManager,
        FormFactoryInterface $formFactory,
        RouterInterface $router,
        AuthorizationCheckerInterface $authenticationChecker,
        AuthenticationUtils $authenticationUtils
    )
    {
        $this->twig = $twig;
        $this->entityManager = $entityManager;
        $this->formFactory = $formFactory;
        $this->router = $router;
        $this->authenticationChecker = $authenticationChecker;
        $this->authenticationUtils = $authenticationUtils;
    }

    /**
     * @Route("/{id}", name="view", methods={"GET"})
     * @param User $user
     * @return string
     * @throws Exception
     */
    public function view(User $user)
    {
        return new Response($this->twig->render('user/view.html.twig', [
            'user' => $user
        ]));
    }

    /**
     * @Route("/new", name="edit", methods={"GET","POST"})
     * @throws Exception
     */
    public function create()
    {
        return new Response($this->twig->render('user/create.html.twig'));
    }

    /**
     * @Route("/edit/{id}", name="edit", methods={"GET","POST"})
     * @param User $user
     * @return Response|RedirectResponse
     * @throws Exception
     */
    public function edit(User $user)
    {
        $form = $this->formFactory->create(UserType::class, $user);

        $form->handleRequest($user);
        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();

            $url = $this->router->generate('user_view', [$user]);
            return new RedirectResponse($url, 302);
        }

        return new Response($this->twig->render('user/edit.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]));
    }

    /**
     * @Route("/delete/{id}", name="delete", methods={"DELETE"})
     * @param User $user
     */
    public function delete(User $user)
    {

    }

    /**
     * @Route("/list", name="list", methods={"GET"})
     * @throws Exception
     */
    public function list()
    {
        $users = $this->entityManager->getRepository(User::class)->findAll();

        return new Response($this->twig->render('user/list.html.twig', [
            'users' => $users
        ]));
    }
}
