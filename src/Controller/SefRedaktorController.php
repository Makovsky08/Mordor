<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SefRedaktorController extends AbstractController
{
    #[Route('/sefredaktor', name: 'app_sef_redaktor')]
    public function index(): Response
    {
        return $this->render('Sef_redaktor/index.html.twig', [
            'controller_name' => 'SefRedaktorController',
        ]);
    }
}
