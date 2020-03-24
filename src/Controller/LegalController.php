<?php

namespace App\Controller;

use Twig\Environment;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

/**
 * @Route("/legal", name="legal_")
 */
class LegalController
{
    /**
     * @var Environment
     */
    private $twig;

    /**
     * @var RouterInterface
     */
    private $router;

    /**
     * @var AuthorizationCheckerInterface
     */
    private $authenticationChecker;

    /**
     * LegalController constructor.
     * @param Environment $twig
     * @param RouterInterface $router
     * @param AuthorizationCheckerInterface $authenticationChecker
     */
    public function __construct(
        Environment $twig,
        RouterInterface $router,
        AuthorizationCheckerInterface $authenticationChecker
    )
    {
        $this->twig = $twig;
        $this->router = $router;
        $this->authenticationChecker = $authenticationChecker;
    }

    /**
     * @Route("/data-protection", name="dataProtection", methods={"GET"})
     * @return string
     * @throws Exception
     */
    public function dataProtection()
    {
        return new Response($this->twig->render('legal/data_protection.html.twig'));
    }

    /**
     * @Route("/back", name="back", methods={"GET","POST"})
     * @return Response
     * @throws Exception
     */
    public function back() : Response
    {
        if ($this->authenticationChecker->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            $url = $this->router->generate('ticket_view_user_list');
            return new RedirectResponse($url, 302);
        }else {
            $url = $this->router->generate('ticket_list');
            return new RedirectResponse($url, 302);
        }

        return new Response($content);
    }
}
