<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AutorController extends AbstractController
{
    #[Route('/autor', name: 'app_autor')]
    public function index(): Response
    {
        return $this->render('autor/index.html.twig', [
            'controller_name' => 'AutorController',
        ]);
    }
}
