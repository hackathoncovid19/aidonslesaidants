<?php

namespace App\Controller;

use Twig\Environment;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\RouterInterface;

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
     * LegalController constructor.
     * @param Environment $twig
     * @param RouterInterface $router
     */
    public function __construct(
        Environment $twig,
        RouterInterface $router
    )
    {
        $this->twig = $twig;
        $this->router = $router;
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
}
