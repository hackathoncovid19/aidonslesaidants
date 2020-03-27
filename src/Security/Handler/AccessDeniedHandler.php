<?php

namespace App\Security\Handler;

use Exception;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Http\Authorization\AccessDeniedHandlerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class AccessDeniedHandler implements AccessDeniedHandlerInterface
{
    /**
     * @var Environment
     */
    private $twig;

    /**
     * AccessDeniedHandler constructor.
     * @param Environment $twig
     */
    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    /**
     * @param Request $request
     * @param AccessDeniedException $accessDeniedException
     * @throws Exception
     */
    public function handle(Request $request, AccessDeniedException $accessDeniedException)
    {
        throw new AccessDeniedHttpException('Vous n\'avez pas accès à cette ressource.');
    }
}
