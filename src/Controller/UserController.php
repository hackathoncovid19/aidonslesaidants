<?php

namespace App\Controller;

use Exception;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Twig\Environment;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
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
 * @Route("/%user_path%", name="user_")
 */
class UserController
{
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
     * @var Environment
     */
    private $twig;

    /**
     * @var AuthorizationCheckerInterface
     */
    private $authenticationChecker;


    /**
     * @var AuthenticationUtils
     */
    private $authenticationUtils;

    /**
     * @var UserPasswordEncoderInterface
     */
    private $passwordEncoder;

    /**
     * UserController constructor.
     * @param Environment $twig
     * @param EntityManagerInterface $entityManager
     * @param FormFactoryInterface $formFactory
     * @param RouterInterface $router ,
     * @param AuthorizationCheckerInterface $authenticationChecker
     * @param AuthenticationUtils $authenticationUtils
     * @param UserPasswordEncoderInterface $passwordEncoder
     */
    public function __construct(
        Environment $twig,
        EntityManagerInterface $entityManager,
        FormFactoryInterface $formFactory,
        RouterInterface $router,
        AuthorizationCheckerInterface $authenticationChecker,
        AuthenticationUtils $authenticationUtils,
        UserPasswordEncoderInterface $passwordEncoder
    )
    {
        $this->twig = $twig;
        $this->entityManager = $entityManager;
        $this->formFactory = $formFactory;
        $this->router = $router;
        $this->authenticationChecker = $authenticationChecker;
        $this->authenticationUtils = $authenticationUtils;
        $this->passwordEncoder = $passwordEncoder;
    }

    /**
     * @Route("/connexion", name="login", methods={"GET","POST"})
     * @return Response
     * @throws Exception
     */
    public function login() : Response
    {
        if ($this->authenticationChecker->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            $url = $this->router->generate('ticket_view_user_list');
            return new RedirectResponse($url, 302);
        }

        $content = $this->twig->render('user/login.html.twig', array(
            'last_username' => $this->authenticationUtils->getLastUsername(),
            'error'         => $this->authenticationUtils->getLastAuthenticationError(),
            'page'          => 'login',
        ));

        return new Response($content);
    }

    /**
     * @IsGranted("VIEW", subject="user")
     * @Route("/view/{id}", name="view", methods={"GET"})
     * @param User $user
     * @return string
     * @throws Exception
     */
    public function view(User $user)
    {
        return new Response(
            $this->twig->render(
                'user/view.html.twig',
                [ 'user' => $user])
        );
    }

    /**
     *  @Route("/enregistrement", name="register", methods={"GET","POST"})
     * @param   Request $request
     * @return  Response|RedirectResponse
     * @throws  Exception
     */
    public function register(Request $request): ?Response
    {
        /** @var User $user */
        $user = new User();
        $form = $this->formFactory->createBuilder(UserType::class, $user)->getForm()->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();
            $user->setRoles(['ROLE_USER']);
            $user->setPassword($this->passwordEncoder->encodePassword($user, $user->getPassword()));

            $this->entityManager->persist($user);
            $this->entityManager->flush();
            
            $url = $this->router->generate('user_login');
            return new RedirectResponse($url, 302);
       }

       return new Response(
           $this->twig->render(
               'user/create.html.twig',
               ['form' => $form->createView()]
           )
       );
    }

    /**
     * @IsGranted("EDIT", subject="user")
     * @Route("/edit/{id}", name="edit", methods={"GET","POST"})
     * @param Request $request
     * @param User $user
     * @return Response|RedirectResponse
     * @throws Exception
     */
    public function edit(Request $request, User $user)
    {
        $form = $this->formFactory->create(UserType::class, $user);

        $form->handleRequest($request);
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
     * @IsGranted("ROLE_ADMIN")
     * @Route("/delete/{id}", name="delete", methods={"DELETE"})
     * @param User $user
     */
    public function delete(User $user)
    {

    }

    /**
     * @IsGranted("ROLE_ADMIN")
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
