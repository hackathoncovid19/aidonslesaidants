<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bridge\Twig\TwigEngine;

class RegisterController
{
    /** @var TwigEngine */
    public $templateEngine;

    public function registerAction() {
        return new Response();
    }
}