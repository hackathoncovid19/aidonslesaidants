<?php

namespace App\Controller;

use Exception;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class HomepageController
{
    /**
     * @var Environment
     */
    private $twig;

    /**
     * HomepageController constructor.
     * @param Environment $twig
     */
    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    /**
     * @Route("/", name="home", methods={"GET","POST"})
     * @throws Exception
     */
    public function home()
    {
        return new Response($this->twig->render('home/home.html.twig'));
    }
}
