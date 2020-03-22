<?php

namespace App\Controller;

use Exception;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\RouterInterface;
use Twig\Environment;

class HomepageController
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
     * HomepageController constructor.
     * @param Environment $twig
     * @param RouterInterface $router
     */
    public function __construct(Environment $twig, RouterInterface $router)
    {
        $this->twig = $twig;
        $this->router = $router;
    }

    /**
     * @Route("/", name="home", methods={"GET","POST"})
     * @throws Exception
     */
    public function home()
    {
        $url = $this->router->generate('ticket_list');
        return new RedirectResponse($url, 302);
    }
}
