<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RedaktorController extends AbstractController
{
    #[Route('/redaktor', name: 'app_redaktor')]
    public function index(): Response
    {
        return $this->render('redaktor/index.html.twig', [
            'controller_name' => 'RedaktorController',
        ]);
    }
}
